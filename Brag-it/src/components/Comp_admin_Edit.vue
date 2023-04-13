<script setup>
import { ref,watch } from 'vue';
import { useRoute } from 'vue-router'

const route = useRoute();


// all of these are automatically bound to the template


// let image= null;

const emits = defineEmits(['refreshed','creationstatus2']);


const prop = defineProps({
    toggleforms:{
        type: Function,
    },
    id:{
        type: Number
    },
    routen:{
        type: String
    }
})

let content=ref(undefined)
let errorMessage = ref('')
let url = "http://127.0.0.1:8000/api/" + route.params.crud + "/" + prop.id ;
function fetchuser(){
    fetch(url)
    .then((response) => response.json()) 
    .then((data) => { 
      content.value = data
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

   
   
   fetch('http://127.0.0.1:8000/api/users/' + prop.id, {
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
   
}).then((response) => {
   if (response.ok) {
        console.log("RESPONSE => ", response.ok)
       return response.json();
   }
   return Promise.reject(response);
}).then ((data) => {
    console.log("IN THEN")
    emits('refreshed')
    emits('creationstatus2', data.message)
    console.log("prout: ",data.message);
    prop.toggleforms()
      
}).catch((error) => {
  error.json().then((data) => {
    const validationErrors = data.errors;
    const messages = Object.keys(validationErrors).map((key) => {
        console.log('messageslog', validationErrors[key][0])
      return validationErrors[key][0];
    });
     errorMessage.value = messages
   
     
    
  });
});

 }




 ////////////////CATEGORIES////////////

 function editCat(namecat,banner,archived) {
    console.log('name =>', namecat)
    console.log('banner =>', banner)
    console.log('archived =>', archived)
  

   
   
   fetch('http://127.0.0.1:8000/api/categories/' + prop.id, {
   method: 'PUT',
   body: JSON.stringify({
       name: namecat,
       banner: banner,
       is_archived: archived,
    
       
   }),
   headers: {
       'Content-type': 'application/json; charset=UTF-8'
   }
   
}).then((response) => {
   if (response.ok) {
        console.log("RESPONSE => ", response.ok)
       return response.json();
   }
   return Promise.reject(response);
}).then ((data) => {
    console.log("IN THEN")
    emits('refreshed')
    emits('creationstatus2', data.message)
    console.log("prout: ",data.message);
    prop.toggleforms()
      
}).catch((error) => {
  error.json().then((data) => {
    const validationErrors = data.errors;
    const messages = Object.keys(validationErrors).map((key) => {
        console.log('messageslog', validationErrors[key][0])
      return validationErrors[key][0];
    });
     errorMessage.value = messages
   
     
    
  });
});

 }




 
 ////////////////POSTS////////////


 let catpost = ref()
// function fetchcatforpost(){
    console.log("IN GO FETCH")
    
    fetch("http://127.0.0.1:8000/api/categories")
        .then((response) => response.json())
        .then((data) => {
            catpost.value = data
        }

        )

 function editPosts(title,contentpost,image,category_id,author,archived) {
    console.log('title =>', title)
    console.log('content =>', contentpost)
    console.log('image =>', image)
    console.log('category =>', category_id)
    console.log('author =>', author)
    console.log('archived =>', archived)
  

   
   
   fetch('http://127.0.0.1:8000/api/posts/' + prop.id, {
   method: 'PUT',
   body: JSON.stringify({
       title: title,
       content: contentpost,
       image_path: image,
        category_id: category_id,
       user_id: author,
       is_archived: archived,
    
       
   }),
   headers: {
       'Content-type': 'application/json; charset=UTF-8'
   }
   
}).then((response) => {
   if (response.ok) {
        console.log("RESPONSE => ", response.ok)
       return response.json();
   }
   return Promise.reject(response);
}).then ((data) => {
    console.log("IN THEN")
    emits('refreshed')
    emits('creationstatus2', data.message)
    console.log("prout: ",data.message);
    prop.toggleforms()
      
}).catch((error) => {
  error.json().then((data) => {
    const validationErrors = data.errors;
    const messages = Object.keys(validationErrors).map((key) => {
        console.log('messageslog', validationErrors[key][0])
      return validationErrors[key][0];
    });
     errorMessage.value = messages
   
     
    
  });
});

 }

//COMMENTS//////////////////////////////////////////// 
 function editCom(contentcom,user_id,category_id,post_id,is_sub_com,reply_to,archived) {
    console.log('content =>', contentcom)
    console.log('is_sub_com =>', is_sub_com)
    console.log('category =>', category_id)
    console.log('post =>', post_id)
    console.log('reply_to =>', reply_to)
    console.log('author =>', user_id)
    console.log('archived =>', archived)
  

   
   
   fetch('http://127.0.0.1:8000/api/comments/' + prop.id, {
   method: 'PUT',
   body: JSON.stringify({
       content: contentcom, 
       is_sub_com: is_sub_com,
       reply_to: reply_to,
       category_id: category_id,
       post_id: post_id,
       user_id: user_id,
       is_archived: archived,
    
       
   }),
   headers: {
       'Content-type': 'application/json; charset=UTF-8'
   }
   
}).then((response) => {
   if (response.ok) {
        console.log("RESPONSE => ", response.ok)
       return response.json();
   }
   return Promise.reject(response);
}).then ((data) => {
    console.log("IN THEN")
    emits('refreshed')
    emits('creationstatus2', data.message)
    console.log("prout: ",data.message);
    prop.toggleforms()
      
}).catch((error) => {
  error.json().then((data) => {
    const validationErrors = data.errors;
    const messages = Object.keys(validationErrors).map((key) => {
        console.log('messageslog', validationErrors[key][0])
      return validationErrors[key][0];
    });
     errorMessage.value = messages
   
     
    
  });
});

 }

 


</script>

<template>
<div class="popup"  v-if="content !== undefined && route.params.crud === 'users'">
    <div class="popup-inner">
<h3> Edit user {{ content.username }}</h3>
<div v-for="(mess, index) in errorMessage" :key="index" style="color:red;font-size: 12px;">{{ mess }}</div>
<form >
    
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" v-model="content.username" required></td>
            </tr>
            <tr>
                <td>Firstname</td>
                <td><input type="text" name="firstname" v-model="content.firstname"></td>
            </tr>
            <tr>
                <td>Lastname</td>
                <td><input type="text" name="lastname" v-model="content.lastname"></td>
            </tr>
            <tr>
                <td>Date of birth</td>
                <td><input class="inputdate" type="date" name="date_of_birth" v-model="content.date_of_birth" 
                 min="1950-01-01" max="2023-01-01"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" v-model="content.password"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" v-model="content.email"></td>
            </tr>
            <tr>
                <td>Avatar_path</td>
                <td><input type="file" name="avatar_path"  @change="handlefileupload"></td>
            </tr>
            <tr>
                <td>Admin</td>
                <td>
                <select class="selectadmin"  name="is_admin" v-model="content.is_admin">
                <option disabled value="">Select the user role</option>
                <option value="1">Yes</option>
                <option  value="0">No</option>
                </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td> <button class="confirm"   v-on:click.prevent="editUser(content.username, content.firstname, content.lastname, content.password, content.email, content.avatar_path, content.date_of_birth, content.is_admin)">Edit</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>

    </form>
    </div>
</div>

<!-- FORM CATEGORIES -->


<div class="popup"  v-if="content !== undefined && route.params.crud === 'categories'">
    <div class="popup-inner">
<h3> Edit category {{ content.name }}</h3>
<div v-for="(mess, index) in errorMessage" :key="index" style="color:red;font-size: 12px;">{{ mess }}</div>
<form >
    
        <table>
            <tr>
                <td>title</td>
                <td><input type="text" name="username" v-model="content.name" required></td>
            </tr>    

            <tr>
                <td>content</td>
                <td><input type="text" name="username" v-model="content.name" required></td>
            </tr>    
            <tr>
                <td>image_path</td>
                <td><input type="file" name="avatar_path"  @change="handlefileupload"></td>
            </tr>
            <tr>
                <td>Archive the category?</td>
                <td>
                <select class="selectadmin"  name="is_admin" v-model="content.is_archived">
                <option disabled value="">Do you want to archive this category?</option>
                <option value="1">Yes</option>
                <option  value="0">No</option>
                </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td> <button class="confirm"   v-on:click.prevent="editCat(content.name, content.banner, content.is_archived, )">Edit</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>

    </form>
    </div>
    
</div>

<!-- FORM POSTS -->

<div class="popup"  v-if="content !== undefined && route.params.crud === 'posts'">
    <div class="popup-inner">
<h3> Edit post {{ content.name }}</h3>
<div v-for="(mess, index) in errorMessage" :key="index" style="color:red;font-size: 12px;">{{ mess }}</div>
<form >
    
        <table>
            <tr>
                <td>title</td>
                <td><input type="text" name="title" v-model="content.title" ></td>
            </tr>  
            <tr>
                <td>Content</td>
                <td><textarea style="font-family:Arial, Helvetica, sans-serif; height: 100px; width: 250px; resize: none;" type="text" name="contentpost" v-model="content.content" > </textarea></td>
            </tr>   
            <tr>
                <td>Avatar_path</td>
                <td><input type="file" name="image_path"  @change="handlefileupload"></td>
            </tr>   
   
            <tr>
                <td>category</td>
                <td>
                    <select  class="selectadmin" type="text" name="category_id" v-model="content.category_id">
                    <option disabled value="">Please select a category</option>
                    <option  v-for="(cat, index) in catpost" :key="index" :value=cat.id> {{ cat.name }}</option>
                    <input type="hidden" name="user_id" v-model="content.user_id" >
                </select>
            </td>
            </tr>   
         

             
            <tr>
                <td>Archive the comment?</td>
                <td>
                <select class="selectadmin"  name="is_admin" v-model="content.is_archived">
                <option disabled value="">Do you want to archive this category?</option>
                <option value="1">Yes</option>
                <option  value="0">No</option>
                </select>
                </td>
            </tr>
            <tr>
                    <!-- title,contentpost,image,category_id,author,archived) -->

                <td></td>
                <td> <button class="confirm"   v-on:click.prevent="editPosts(content.title, content.content, content.image_path, content.category_id, content.user_id, content.is_archived, )">Edit</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>

    </form>
    </div>
    
</div>



<!-- FORM COMMENTS -->

<div class="popup"  v-if="content !== undefined && route.params.crud === 'comments'">
    <div class="popup-inner">
<h3> Edit comment <br /> {{ content.name }}</h3>
<div v-for="(mess, index) in errorMessage" :key="index" style="color:red;font-size: 12px;">{{ mess }}</div>
<form >
    
        <table>
       
            <tr>
                <td>Content</td>
                <td><textarea style="font-family:Arial, Helvetica, sans-serif; height: 100px; width: 250px; resize: none;" type="text" name="contentpost" v-model="content.content" > </textarea>
                    <input type="hidden" name="user_id" v-model="content.user_id" >
                    <input type="hidden" name="category_id" v-model="content.category_id" >
                    <input type="hidden" name="post_id" v-model="content.post_id" >
                    <input type="hidden" name="is_sub_com" v-model="content.is_sub_com" >
                    <input type="hidden" name="reply_to" v-model="content.reply_to" >

                </td>
            </tr>   
    
            <tr>
                <td>Archive the comment?</td>
                <td>
                <select class="selectadmin"  name="is_admin" v-model="content.is_archived">
                <option disabled value="">Do you want to archive this comment?</option>
                <option value="1">Yes</option>
                <option  value="0">No</option>
                </select>
                </td>
            </tr>
            <tr>
                    <!-- title,contentpost,image,category_id,author,archived) -->

                <td></td>
                <td> <button class="confirm"   v-on:click.prevent="editCom(content.content, content.user_id, content.category_id, content.post_id, content.is_sub_com,content.reply_to, content.is_archived)">Edit</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>

    </form>
    </div>
    
</div>

</template>

<style scoped>
td{
    border:none;
}

</style>

