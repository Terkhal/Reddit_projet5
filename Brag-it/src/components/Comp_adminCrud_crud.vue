<script setup>
import {useRoute} from 'vue-router'
import {ref,watch} from 'vue';
import createbut from './Comp_admin_Create.vue';
import deletebut from './Comp_admin_Delete.vue';
import editbut from './Comp_admin_Edit.vue';

const route = useRoute();
const popup =ref({
  create: false,
  edit: false,
  delete: false,
})

let selectedUserId = null;

const toggleforms = (trigger, userid) => {
  popup.value[trigger] = !popup.value[trigger]
  selectedUserId = userid
}

let message = ref('')
//form status
function creationstatusmessage(value){
    console.log('ça emit bien')
    message.value = value;
    console.log(message)
}



// let item = "";
let crud = ref()
function gofetch(param) {
let url = "http://127.0.0.1:8000/api/" + param ;
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
    
     <div class="crud" v-if="route.params.crud == 'users'">
        <button class="crudcreate" v-on:click="toggleforms('create')"> Create {{ route.params.crud }} </button>
        <createbut  v-if="popup.create" :toggleforms="()=>toggleforms('create')" @refresh="gofetch(route.params.crud)" @creationstatus="creationstatusmessage" />
        <div>{{ message }}</div>
     
        <table class="crudtable">
            <tr>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Admin</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr v-for="(unit, index) in crud" :key="index">
                <td>{{ unit.username }}</td>
                <td>{{ unit.firstname }}</td>
                <td>{{ unit.lastname }}</td>
                <td>{{ unit.is_admin }}</td>
                <td><button class="admin_edit" v-on:click="toggleforms('edit' ,unit.id)">Edit</button>
                    <editbut v-if="popup.edit" :toggleforms="()=>toggleforms('edit',unit.id)" :userid="selectedUserId" @refreshed="gofetch(route.params.crud)" @creationstatus="creationstatusmessage"/></td>
                <td><button class="admin_delete" v-on:click="toggleforms('delete',unit.id)">X</button>
                    <deletebut v-if="popup.delete" :toggleforms="()=>toggleforms('delete',unit.id)" :userid="selectedUserId" @refresheded="gofetch(route.params.crud)" @creationstatus="creationstatusmessage"/></td>
            </tr>
            </table>
        
    </div>
    <div v-if="route.params.crud == 'categories'">
        <button>Create {{ route.params.crud }}</button>
     
     <table id="crudtable">
        <thead>
         <tr>
             <th class="thcrud">name</th>
             <th class="thcrud">img</th>
             <th class="thcrud">archived</th>
             <th class="thcrud">edit</th>
             <th class="thcrud">delete</th>
         </tr>
        </thead>
         <tr v-for="(unit, index) in crud" :key="index">
             <td class="tdcrud">{{ unit.name }}</td>
             <td class="tdcrud">{{ unit.banner }}</td>
             <td class="tdcrud">{{ unit.is_archived }}</td>
             <td class="tdcrud">Edit</td>
             <td class="tdcrud">X</td>
         </tr>
         </table>
    </div>
    <div v-if="route.params.crud == 'posts'">
        <button>Create {{ route.params.crud }}</button>
    </div>
    <div v-if="route.params.crud == 'comments'">

        <button>Create {{ route.params.crud }}</button>
    </div>
</template>

<style>




</style>
