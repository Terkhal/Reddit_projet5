<script setup>
import { ref,watch } from 'vue';


// all of these are automatically bound to the template


// let image= null;

const emit = defineEmits(['refreshed','creationstatus2'])


const prop = defineProps({
    toggleforms:{
        type: Function,
    },
    userid:{
        type: Number
    }
})

let user=ref()

let url = "http://127.0.0.1:8002/api/users/" + prop.userid ;
function fetchuser(){
    fetch(url)
    .then((response) => response.json()) 
    .then((data) => { 
      user.value = data
     }
    
    )

}


fetchuser(prop.userid);
watch(() => prop.userid, () => {
    fetchuser(prop.userid);
    console.log('imwatching')
    
})


function editUser(username,firstname,lastname,password,email,avatar_path,date_of_birth,is_admin) {
    console.log('username =>', username)
    console.log('firstname =>', firstname)
    console.log('lastname =>', lastname)
    console.log('password =>', password)
    console.log('email =>', email)
    console.log('avatar_path =>', avatar_path)
    console.log('date_of_birth =>', date_of_birth)
    console.log('is_admin =>', is_admin)

   
   
   fetch('http://127.0.0.1:8002/api/users/' + prop.userid, {
   method: 'PUT',
   body: JSON.stringify({
       username: username,
       firstname: firstname,
       lastname: lastname,
       password: password,
       email: email,
       avatar_path: avatar_path,
       date_of_birth: date_of_birth,
       is_admin: is_admin
       
   }),
   headers: {
       'Content-type': 'application/json; charset=UTF-8'
   }
   
}).then(function (response) {
   if (response.ok) {
       emit('refreshed')
       
       return response.json();
   }
   return Promise.reject(response);
}).then ((data) => {
   
    emit('creationstatus2', data.message)
    console.log("prout: ",data.message);
      
}).catch((error) => {
    emit('creationstatus2', error)
   console.warn('invalid query', error);

   
   
});

 }



</script>

<template>
<div class="popup">
    <div class="popup-inner">
<h3> Edit a new user {{ userid }}</h3>
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" v-model="user.username"></td>
            </tr>
            <tr>
                <td>Firstname</td>
                <td><input type="text" name="firstname" v-model="user.firstname"></td>
            </tr>
            <tr>
                <td>Lastname</td>
                <td><input type="text" name="lastname" v-model="user.lastname"></td>
            </tr>
            <tr>
                <td>Date of birth</td>
                <td><input class="inputdate" type="date" name="date_of_birth" v-model="user.date_of_birth" 
                 min="1950-01-01" max="2023-01-01"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" v-model="user.password"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" v-model="user.email"></td>
            </tr>
            <tr>
                <td>Avatar_path</td>
                <td><input type="file" name="avatar_path"  @change="handlefileupload"></td>
            </tr>
            <tr>
                <td>Admin</td>
                <td>
                <select class="selectadmin"  name="is_admin" v-model="user.is_admin">
                <option disabled value="">Select the user role</option>
                <option value="1">Yes</option>
                <option  value="0">No</option>
                </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td> <button class="confirm"  @click="toggleforms()" v-on:click="editUser(user.username, user.firstname, user.lastname, user.password, user.email, user.avatar_path, user.date_of_birth, user.is_admin)">Edit</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>

  
    </div>
</div>


</template>

<style scoped>
td{
    border:none;
}

</style>

