<script setup>
import { ref,watch } from 'vue';
import { useRoute } from 'vue-router';
import Cookies from 'js-cookie';
let cookieuserid = Cookies.get('userid');


let errorMessage = ref('')
// userfield
let username=ref("");
let firstname=ref("");
let lastname=ref("");
let password=ref("");
let email=ref("");
let avatar_path=ref("");
let is_admin=ref("");
let date_of_birth=ref("");

//categories field

let name=ref("");
let banner=ref("");

//Post field

let title=ref("");
let content=ref("");
let image_path=ref("");


//Comment field

let contentpost=ref("");
let is_sub_com=ref("");
let reply_to=ref("");
let post_id=ref("");

//SHARED value
let user_id=cookieuserid;
let category_id=ref("");
let is_archived=ref("");

//ROUTE PARAM
const route = useRoute()
// let image= null;

const emit = defineEmits(['refresh','creationstatus']);
const prop = defineProps({
    toggleforms:{
        type: Function,
    }
})
// CREATE USER
function createUser() {
  
    console.log('username =>', username.value)
    console.log('firstname =>', firstname.value)
    console.log('lastname =>', lastname.value)
    console.log('password =>', password.value)
    console.log('email =>', email.value)
    console.log('avatar_path =>', avatar_path.value)
    console.log('date_of_birth =>', date_of_birth.value)
    console.log('is_admin =>', is_admin.value)

   
   
   fetch('http://127.0.0.1:8000/api/users', {
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
   
}).then(async function (response) {
   if (response.ok) {
       emit('refresh')
     return response.json();
   }
   return Promise.reject(await response.json());
}).then ((data) => {
    emit('creationstatus', data.message)
    console.log("prout: ",data.message);
    prop.toggleforms()
      
}).catch((error) => {
  console.log(error);
  const validationErrors = error.errors;
  const messages = Object.keys(validationErrors).map((key) => {
    console.log('messageslog', validationErrors[key][0]);
    return validationErrors[key][0];
  });
  errorMessage.value = messages;
});


 }


 //CREATE CATEGORY
 function createCat() {
  
  console.log('name =>', name.value)
  console.log('banner =>', banner.value)
  console.log('archived =>', is_archived.value)
  

 
 
 fetch('http://127.0.0.1:8000/api/categories', {
 method: 'POST',
 body: JSON.stringify({
     name: name.value,
     banner: banner.value,
     is_archived: is_archived.value,

     
 }),
 headers: {
     'Content-type': 'application/json; charset=UTF-8'
 }
 
}).then(async function (response) {
 if (response.ok) {
     emit('refresh')
   return response.json();
 }
 return Promise.reject(await response.json());
}).then ((data) => {
  emit('creationstatus', data.message)
  console.log("prout: ",data.message);
  prop.toggleforms()
    
}).catch((error) => {
console.log(error);
const validationErrors = error.errors;
const messages = Object.keys(validationErrors).map((key) => {
  console.log('messageslog', validationErrors[key][0]);
  return validationErrors[key][0];
});
errorMessage.value = messages;
});


}



 //CREATE POSTS
 let catpost = ref()
// function fetchcatforpost(){
    console.log("IN GO FETCH")
    let url = "http://127.0.0.1:8000/api/categories";
    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            catpost.value = data
        }

        )
    // }


//     watch(() => route.params.crud, () => {
//    fetchcatforpost();
  
    
// })

 function createPosts() {

    console.log('title =>', title.value)
    console.log('content =>', contentpost.value)
    console.log('user_id =>', user_id)
    console.log('category_id =>', category_id.value)
    console.log('image_path =>', image_path.value)
    // console.log('is_sub_com =>', is_sub_com.value)
    // console.log('reply_to =>', reply_to.value)
    console.log('archived =>', is_archived.value)
  

 
 
 fetch('http://127.0.0.1:8000/api/posts', {
 method: 'POST',
 body: JSON.stringify({
     title: title.value,
     content: contentpost.value,
     user_id: user_id,
     category_id: category_id.value,
     image_path: image_path.value,


     is_archived: is_archived.value,

     
 }),
 headers: {
     'Content-type': 'application/json; charset=UTF-8'
 }
 
}).then(async function (response) {
 if (response.ok) {
     emit('refresh')
   return response.json();
 }
 return Promise.reject(await response.json());
}).then ((data) => {
  emit('creationstatus', data.message)
  console.log("prout: ",data.message);
  prop.toggleforms()
    
}).catch((error) => {
console.log(error);
const validationErrors = error.errors;
const messages = Object.keys(validationErrors).map((key) => {
  console.log('messageslog', validationErrors[key][0]);
  return validationErrors[key][0];
});
errorMessage.value = messages;
});


}


</script>

<template>
<div class="popup">
    <div class="popup-inner">
 <h3> Create {{route.params.crud}}</h3>
<div v-for="(mess, index) in errorMessage" :key="index" style="color:red;font-size: 12px;">{{ mess }}</div>
<form>
        <table v-if="route.params.crud == 'users'">
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" v-model="username" required></td>
            </tr>
            <tr>
                <td>Firstname</td>
                <td><input type="text" name="firstname" v-model="firstname" required></td>
            </tr>
            <tr>
                <td>Lastname</td>
                <td><input type="text" name="lastname" v-model="lastname" required></td>
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
                <td> <button class="confirm"  v-on:click.prevent="createUser()">Create</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>

        
        <table v-if="route.params.crud == 'categories'">
            <tr>
                <td>Category Name</td>
                <td><input type="text" name="name" v-model="name" required></td>
            </tr>
          
            <tr>
                <!-- <button class="btn btn-info" @click="onPickFile">Upload profile picture</button>v -->
                <td>Avatar_path</td>
                <td><input type="file" name="avatar_path"  @change="handlefileupload"></td>
            </tr>
            <tr>
                <td>Archived</td>
                <td>
                <select class="selectadmin" type="text" name="is_archived" v-model="is_archived">
                <option disabled value="">No</option>
                <option value="1">Yes</option>
           
                </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td> <button class="confirm"  v-on:click.prevent="createCat()">Create</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>
     

        <table v-if="route.params.crud == 'posts'">
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" v-model="title" ></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><textarea style="font-family:Arial, Helvetica, sans-serif; height: 100px; width: 250px; resize: none;" type="text" name="contentpost" v-model="contentpost" > </textarea></td>
            </tr>
            <tr>
                <td>Select Category</td>
                <td>
                <select  class="selectadmin" type="text" name="category_id" v-model="category_id">
                    <option disabled value="">Please select a category</option>
                    <option  v-for="(cat, index) in catpost" :key="index" :value=cat.id> {{ cat.name }}</option>
             
              </select>
                </td>
            </tr>
          
            <tr>
                <!-- <button class="btn btn-info" @click="onPickFile">Upload profile picture</button>v -->
                <td>Image</td>
                <td><input type="file" name="image_path"  @change="handlefileupload"></td>
            </tr>
            <tr>
                <td>Archived</td>
                <td>
                <select class="selectadmin" type="text" name="is_archived" v-model="is_archived">
                <option disabled value="">No</option>
                <option value="1">Yes</option>
           
                </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td> <button class="confirm"  v-on:click.prevent="createPosts">Create</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>

    </form>
      
    </div>
</div>


</template>

<style scoped>


</style>

