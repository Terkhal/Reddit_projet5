<script setup>
import {ref, onMounted} from 'vue';
import loginpop from './Comp_home_loginpopup.vue';
import signuppop from './Comp_signup_form.vue';
import Cookies from 'js-cookie';

const emit = defineEmits('isloggedin')
let userlogname = ref('')
let useradmin = ref('')
const popup =ref({
  btrigger: false,
  signup:false
})

let email = ref('');
let password = ref('');



// onMounted(() => {

// });

function logout(){
  Object.keys(Cookies.get()).forEach(function(cookieName) {
  Cookies.remove(cookieName);
  isloggedin()
  
});
}


function isloggedin(){

const userCookiename = Cookies.get('userfirstname');
const tokenCookie = Cookies.get('token');
const adminCookie = Cookies.get('useradmin');
if (tokenCookie) {
  userlogname.value = userCookiename
  useradmin.value = adminCookie
  console.log('hello cookie', userCookiename);
  console.log('hello cookie', tokenCookie);
  console.log('the user is logged in');
  return emit('isloggedin', true)
} else {
  console.log('the user is logged out');
  return emit('isloggedin', false)
}
}


isloggedin()

// managing cookie


function connectUser(){
  console.log('email is:',email.value)
  console.log('password is:',password.value)
  fetch('http://127.0.0.1:8000/api/auth/login', {
	method: 'POST',
	body: JSON.stringify({
		email: email.value,
		password: password.value,
	}),
	headers: {
		'Content-type': 'application/json; charset=UTF-8'
	}
}).then(function (response) {
	if (response.ok) {

  
		return response.json();
	}
	return Promise.reject(response);
}).then ((data) => {
  console.log('this will be my cookie', data.user)
     Cookies.set('userid', data.user.id, { expires: 7 });
     Cookies.set('userfirstname', data.user.firstname, { expires: 7 });
     Cookies.set('userlastname', data.user.lastname, { expires: 7 });
     Cookies.set('useradmin', data.user.is_admin, { expires: 7 });
    Cookies.set('token', data.token, { expires: 7 });
	 console.log("return: ",data.user, { expires: 7});
 
   const userCookiename = Cookies.get('userfirstname');
   const tokenCookie = Cookies.get('token');
if (tokenCookie) {
  isloggedin()
} else {
  // The 'user' cookie does not exist
}






}).catch((error) => {
	console.warn('invalid query', error);
});



}

const togglepop = (trigger) =>{

  popup.value[trigger] = !popup.value[trigger]

}


// function getUser() {
// 	const user = Cookies.get('user');
//   console.log('hello',user.firstname);
// 	if (user) {
// 		userName.value = user.firstname; // replace 'firstName' with the actual property name that holds the first name
// 	}
// }

// getUser();
</script>

<template>
<div class="navbar">
  <div v-if="!userlogname"> <button class = "signup-button" v-on:click="togglepop('signup')">  
         Sign up
      </button></div>
      <signuppop v-if="popup.signup" :togglepopup="()=>togglepop('signup')" />
  <div v-if="!userlogname" >
       <button class = "signup-button" v-on:click="togglepop('btrigger')">  
         Login
      </button>
      <loginpop v-if="popup.btrigger" :togglepopup="()=>togglepop('btrigger')">
      
        <h1>Sign In Form</h1>
        
        <div>
        <span class = "signup-span">Email</span><br>
        <input class = "signup-input" type="text"
        v-model="email" placeholder="Enter your email"> 
        </div>
        <div> 
        <span class = "signup-span">Password</span><br>
        <input class = "signup-input" type="password"
        v-model="password" placeholder="Enter your password">
        </div>
        <button class="confirm" @click="connectUser"  
        v-on:click.prevent="togglepop('btrigger')">Connect</button>
      </loginpop>
     
  </div>



  <div class="dropdown" v-if="userlogname">
      <button class="dropbtn">  
        <h3>Hello {{ userlogname }}  ⌄
        </h3>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <RouterLink  v-if="useradmin == 1" :to="'/admin'"> Admin </RouterLink>   
      <RouterLink :to="'/user/{{user_id}}'"> Profile </RouterLink> 
      <RouterLink :to="'/'" @click="logout"> Logout </RouterLink> 
    </div>
  </div>

</div>
</template>

<style>

</style>