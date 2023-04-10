<script setup>
import { ref } from 'vue';


// all of these are automatically bound to the template

let username=ref("");
let firstname=ref("");
let lastname=ref("");
let password=ref("");
let email=ref("");
let avatar_path=ref("");
let is_admin=ref("");
let date_of_birth=ref("");
// let image= null;

const emit = defineEmits(['refresh','creationstatus'])


const prop = defineProps({
    toggleforms:{
        type: Function,
    }
})

function createUser() {
    console.log('username =>', username.value)
    console.log('firstname =>', firstname.value)
    console.log('lastname =>', lastname.value)
    console.log('password =>', password.value)
    console.log('email =>', email.value)
    console.log('avatar_path =>', avatar_path.value)
    console.log('date_of_birth =>', date_of_birth.value)
    console.log('is_admin =>', is_admin.value)

   
   
   fetch('http://127.0.0.1:8002/api/users', {
   method: 'POST',
   body: JSON.stringify({
       username: username.value,
       firstname: firstname.value,
       lastname: lastname.value,
       password: password.value,
       email: email.value,
       avatar_path: avatar_path.value,
       date_of_birth: date_of_birth.value,
       is_admin: is_admin.value,
       
   }),
   headers: {
       'Content-type': 'application/json; charset=UTF-8'
   }
   
}).then(function (response) {
   if (response.ok) {
       emit('refresh')
       
       return response.json();
   }
   return Promise.reject(response);
}).then ((data) => {
    emit('creationstatus', data.message)
    console.log("prout: ",data.message);
      
}).catch((error) => {
    emit('creationstatus', error)
   console.warn('invalid query', error);

   
   
});

 }



</script>

<template>
<div class="popup">
    <div class="popup-inner">
<h3> Create a new user</h3>
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" v-model="username"></td>
            </tr>
            <tr>
                <td>Firstname</td>
                <td><input type="text" name="firstname" v-model="firstname"></td>
            </tr>
            <tr>
                <td>Lastname</td>
                <td><input type="text" name="lastname" v-model="lastname"></td>
            </tr>
            <tr>
                <td>Date of birth</td>
                <td><input class="inputdate" type="date" name="date_of_birth" v-model="date_of_birth" 
                 min="1950-01-01" max="2023-01-01"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" v-model="password"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" v-model="email"></td>
            </tr>
            <tr>
                <!-- <button class="btn btn-info" @click="onPickFile">Upload profile picture</button>v -->
                <td>Avatar_path</td>
                <td><input type="file" name="avatar_path"  @change="handlefileupload"></td>
            </tr>
            <tr>
                <td>Admin</td>
                <td>
                <select class="selectadmin" type="text" name="is_admin" v-model="is_admin">
                <option disabled value="">Select the user role</option>
                <option value="1">Yes</option>
                <option  value="0">No</option>
                </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td> <button class="confirm"  v-on:click="createUser()">Create</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>
     
       
      
    </div>
</div>


</template>

<style scoped>


</style>

