
<script setup>
import { useRoute } from 'vue-router'
import { ref, watch, computed } from 'vue';
import createbut from './Comp_admin_Create.vue';
import deletebut from './Comp_admin_Delete.vue';
import editbut from './Comp_admin_Edit.vue';



// search filter
let searchTerm = ref('');
const filteredCrud = computed(() => {
  if (!crud.value) return [];
  
  const searchProps = ['username','user' ,'firstname','user.username','category.name', 'lastname','posts_count','name','banner','comments_count','post_id','is_admin','is_archived','content','title','is_sub_com','reply_to'];
  const regex = new RegExp(searchTerm.value, 'i');

  return crud.value.filter((unit) => {
    return searchProps.some((prop) => {
  if (!unit[prop]) return false;
  return regex.test(unit[prop]);
});
  });
});


const route = useRoute();
const popup = ref({
    create: false,
    edit: false,
    delete: false,
})

let selectedId = null;
let selectedRoute = null;
let selectedName = null;

const toggleforms = (trigger, id, routename, name) => {
    popup.value[trigger] = !popup.value[trigger]
    selectedId = id;
    selectedRoute = routename;
    selectedName = name;
}

let message = ref('')
//form status
function creationstatusmessage(value) {
    console.log('ça emit bien')
    message.value = value;
    console.log(message)
}



//fetch dedicated table
let crud = ref()
function gofetch(param) {
  let url = "http://127.0.0.1:8000/api/" + param;
  return fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      crud.value = data;
      return data;
    })
    .catch((error) => {
      console.error(error);
      return null;
    });
}

gofetch(route.params.crud);
console.log('je refresh')
watch(() => route.params.crud, () => {
  const fetchedData = gofetch(route.params.crud);
  console.log('je regarde', fetchedData)
  if (fetchedData) {
    fetchedData.then((data) => {
        console.log('data', data)
      crud.value = data; // update the crud.value object with new data
    }).catch((error) => {
      console.error(error);
    });
  }
});


//////////// search test



</script>


<template>
    
<createbut v-if="popup.create" :toggleforms="() => toggleforms('create')" @refresh="gofetch(route.params.crud)"
    @creationstatus="creationstatusmessage" />
    <editbut v-if="popup.edit" :toggleforms="() => toggleforms('edit', id, routename)" :id="selectedId" :routen="selectedRoute"
                    @refreshed="gofetch(route.params.crud)" @creationstatus2="creationstatusmessage" />
    <deletebut v-if="popup.delete" :toggleforms="() => toggleforms('delete',  id, routename)" :id="selectedId" :routen="selectedRoute" :name="selectedName"
    @refresheded="gofetch(route.params.crud)" @creationstatus3="creationstatusmessage" />
    <div class="crud" v-if="route.params.crud == 'users'">
        <button class="crudcreate" v-on:click="toggleforms('create')"> Create {{ route.params.crud }} </button>
        <p>{{ message }}</p>

        <input type="text" v-model="searchTerm" placeholder="Search...">

                        <!-- @refreshed="(e) => gofetch(route.params.crud)" @creationstatus2="creationstatusmessage" /> -->
        <table class="crudtable">
            <tr>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Posts Nbr</th>
                <th>Comments Nbr</th>
                <th>Admin</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr v-for="(unit, index) in filteredCrud" :key="index">
                <td>{{ unit.username }}</td>
                <td>{{ unit.firstname }}</td>
                <td>{{ unit.lastname }}</td>
                <td v-if="unit.posts_count !== undefined">{{ unit.posts_count }}</td>
                <td v-if="unit.comments_count !== undefined">{{ unit.comments_count }}</td>
                <td>{{ unit.is_admin }}</td>
                <td><button class="admin_edit" v-on:click="toggleforms('edit', unit.id, route.params.crud, unit.username)">Edit</button>
                    
                </td>
                <td><button class="admin_delete" v-on:click="toggleforms('delete', unit.id, route.params.crud, unit.username)">X</button>
                  
                </td>
            </tr>
        </table>

    </div>

    <!-- CATEGORIES //////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="crud" v-if="route.params.crud == 'categories'">
        <button class="crudcreate" v-on:click="toggleforms('create')"> Create {{ route.params.crud }} </button>
        <p>{{ message }}</p>
        <input type="text" v-model="searchTerm" placeholder="Search...">
        <table class="crudtable">
            <tr>
                <th>Name</th>
                <th>Banner</th>
                <th>Posts Nbr</th>
                <th>Comments Nbr</th>
                <th>Archived</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr v-for="(unit, index) in filteredCrud" :key="index">
                <td>{{ unit.name }}</td>
                <td>{{ unit.banner }}</td>
                <td v-if="unit.posts_count !== undefined">{{ unit.posts_count }}</td>
                <td v-if="unit.comments_count !== undefined">{{ unit.comments_count }}</td>
                <td>{{ unit.is_archived }}</td>
                <td><button class="admin_edit" v-on:click="toggleforms('edit',unit.id, route.params.crud, unit.name)">Edit</button>
                </td>
                <td><button class="admin_delete" v-on:click="toggleforms('delete',unit.id, route.params.crud, unit.name)">X</button> 
                </td>
            </tr>
        </table>
</div>

<!-- POSTS //////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <div class="crud" v-if="route.params.crud == 'posts'">
        <button class="crudcreate" v-on:click="toggleforms('create')"> Create {{ route.params.crud }} </button>
        <p>{{ message }}</p>
        <input type="text" v-model="searchTerm" placeholder="Search...">
        <table class="crudtable">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Comments Nbr</th>
                <th>Archived</th>
                <th>author</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr v-for="(unit, index) in filteredCrud" :key="index">
                <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">{{ unit.title }}</td>
                <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">{{ unit.content }}</td>
                <td >{{ unit.category?.name }}</td>
                <td v-if="unit.comments_count !== undefined">{{ unit.comments_count }}</td>
                <td>{{ unit.is_archived }}</td>
                <td >{{ unit.user?.username }}</td>
                <td><button class="admin_edit" v-on:click="toggleforms('edit',unit.id, route.params.crud, unit.title)">Edit</button>
                </td>
                <td><button class="admin_delete" v-on:click="toggleforms('delete',unit.id, route.params.crud, unit.title)">X</button> 
                </td>
            </tr>
        </table>
    </div>
    <!-- COMMENTS //////////////////////////////////////////////////////// -->
    <div class="crud" v-if="route.params.crud == 'comments'">
        <p>{{ message }}</p>
        <input type="text" v-model="searchTerm" placeholder="Search...">
        <table class="crudtable">
            <tr>
                <th>Id</th>
                <th>Content</th>
                <th>Post title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Reply to</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr v-for="(unit, index) in filteredCrud" :key="index">
                <td>{{ unit.id }}</td>
                <td>{{ unit.content }}</td>
                <td >{{ unit.post?.title }}</td>
                <td >{{ unit.category?.name }}</td>
                <td>{{ unit.user?.username }}</td>
                <td>{{ unit.reply_to }}</td>
                <td><button class="admin_edit" v-on:click="toggleforms('edit',unit.id, route.params.crud, unit.title)">Edit</button>
                </td>
                <td><button class="admin_delete" v-on:click="toggleforms('delete',unit.id, route.params.crud, unit.title)">X</button> 
                </td>
            </tr>
        </table>
    </div>
    
</template>

<style></style>
