<script setup>
    // function putuser () {
    // const url = http://127.0.0.1:8000/api/auth/register;
    // }

import { ref } from 'vue';

  // all of these are automatically bound to the template
  
  let firstname=ref("");
  let lastname=ref("");
  let username=ref("");
  let email=ref("");
  let password=ref("");

  // const emit = defineEmits(['title','content','id',"feedarray"])

    
  function addUser() {
   
    // console.log("first:",firstname.value)
    // console.log("last:",lastname.value)
    // console.log("user:",username.value)
    // console.log("email:",email.value)
    // console.log("password:",password.value)
    
    fetch('http://127.0.0.1:8000/api/auth/register', {
	method: 'POST',
	body: JSON.stringify({
		firstname: firstname.value,
		lastname: lastname.value,
        username: username.value,
        email: email.value,
        password: password.value,
        is_admin: "0",
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

console.log("feedback: ",data);

}).catch((error) => {
	console.warn('invalid query', error);
});

}


</script>

<template>
    <div>
      <form @submit.prevent="submitForm" v-if="!formSubmitted">

        <span>First Name</span><br>
        <input 
          v-model="firstname"
          name="firstname"
          type="text" required
          placeholder="Enter your first name" 
        /><br>

        <span>Last Name</span><br>
        <input 
          v-model="lastname"
          name="lastname"
          type="text" required
          placeholder="Enter your last name" 
        /><br>

        <span>Username</span><br>
        <input 
          v-model="username"
          name="username"
          type="text" required
          placeholder="Enter your User name" 
        /><br>

        <span>Email</span><br>
        <input 
          v-model="email"
          name="email"
          type="email" required
          placeholder="Enter your email" 
        /><br>

        <span>Password</span><br>
        <input 
          v-model="password"
          name="password"
          type="text" required
          placeholder="Enter your password" 
        /><br>
        
        <button v-on:click="addUser">Sign Up !</button>
      </form>
      <div v-if="formSubmitted">
        <h3>Form Submitted</h3>
        <p>Firstame: {{ firstname }}</p>
        <p>Lastname: {{ lastname }}</p>
        <p>Userame: {{ username }}</p>
        <p>Email: {{ email }}</p>
        <p>Password: {{ password }}</p>
        <small>Please refresh the page</small>
      </div>
    </div>
  </template>
  
  <style scoped>
    form {
      padding: 10px;
      border: 2px solid black;
      border-radius: 5px;
    }
  
    input {
      padding: 4px 8px;
      margin: 4px;
    }
  
    span {
      font-size: 18px;
      margin: 4px;
      font-weight: 500;
    }
  
    .submit {
      font-size: 15px;
      color: #fff;
      background: #222;
      padding: 6px 12px;
      border: none;
      margin-top: 8px;
      cursor: pointer;
      border-radius: 5px;
    }
  
  </style>