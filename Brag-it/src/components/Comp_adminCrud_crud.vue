<script setup>
import { useRoute } from 'vue-router'
import { ref, watch } from 'vue';
import createbut from './Comp_admin_Create.vue';
import deletebut from './Comp_admin_Delete.vue';
import editbut from './Comp_admin_Edit.vue';

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
    console.log("IN GO FETCH")
    let url = "http://127.0.0.1:8000/api/" + param;
    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            crud.value = data
        }

        )
}


gofetch(route.params.crud);
console.log('je refresh')
watch(() => route.params.crud, () => {
    gofetch(route.params.crud);
    console.log(crud)
    
})





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
            <tr v-for="(unit, index) in crud" :key="index">
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
            <tr v-for="(unit, index) in crud" :key="index">
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
            <tr v-for="(unit, index) in crud" :key="index">
                <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">{{ unit.title }}</td>
                <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">{{ unit.content }}</td>
                <td v-if="unit.category !== undefined">{{ unit.category.name }}</td>
                <td v-if="unit.comments_count !== undefined">{{ unit.comments_count }}</td>
                <td>{{ unit.is_archived }}</td>
                <td v-if="unit.user !== undefined">{{ unit.user.username }}</td>
                <td><button class="admin_edit" v-on:click="toggleforms('edit',unit.id, route.params.crud, unit.title)">Edit</button>
                </td>
                <td><button class="admin_delete" v-on:click="toggleforms('delete',unit.id, route.params.crud, unit.title)">X</button> 
                </td>
            </tr>
        </table>
    </div>
    <!-- COMMENTS //////////////////////////////////////////////////////// -->
    <div class="crud" v-if="route.params.crud == 'comments'">
        <button class="crudcreate" v-on:click="toggleforms('create')"> Create {{ route.params.crud }} </button>
        <p>{{ message }}</p>
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
            <tr v-for="(unit, index) in crud" :key="index">
                <td>{{ unit.id }}</td>
                <td>{{ unit.content }}</td>
                <td v-if="unit.post !== undefined">{{ unit.post.title }}</td>
                <td v-if="unit.category !== undefined">{{ unit.category.name }}</td>
                <td v-if="unit.user !== undefined">{{ unit.user.username }}</td>
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
