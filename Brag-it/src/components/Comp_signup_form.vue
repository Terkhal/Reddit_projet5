<script setup>


import { ref } from 'vue';
  
// setTimeout( () => this.$router.push({ path: '/'}), 5000);

  let errormessage=ref("");
  let firstname=ref("");
  let lastname=ref("");
  let username=ref("");
  let email=ref("");
  let password=ref("");
  let date_of_birth=ref("");
  
  // let picture=ref("");

    
  function addUser() {
   
    console.log("first:",firstname.value)
    console.log("last:",lastname.value)
    console.log("user:",username.value)
    console.log("email:",email.value)
    console.log("password:",password.value)
    console.log("birthday:",date_of_birth.value)

    // console.log("picture:",picture.value)
    
  fetch('http://127.0.0.1:8000/api/auth/register', {
	method: 'POST',
	body: JSON.stringify({
		firstname: firstname.value,
		lastname: lastname.value,
    username: username.value,
    email: email.value,
    password: password.value,
    date_of_birth: date_of_birth.value,
    is_admin: "0",

    // picture: picture.value,
	}),

	headers: {
		'Content-type': 'application/json; charset=UTF-8'
	}
    
}).then(async function (response) {
	if (response.ok) {
        
		return response.json();
	}
	return Promise.reject(await response.json());

}).then ((data) => {

console.log("feedback: ",data);

}).catch((error) => {
  console.log('my errors => ',error);
  const validationErrors = error.errors;
  const messages = Object.keys(validationErrors).map((key) => {
    console.log('messageslog', validationErrors[key][0]);
    return validationErrors[key][0];
  });

  errormessage.value = messages;
  console.log('my messages => ',messages);
});

}

</script>

<template>
    <form class = "signup" @submit.prevent="submit" v-if="!savingSuccessful">
       <h1>Sign Up Form</h1>
       <div style="color:red;font-size: 12px;" v-for="(message,index) in errormessage" :key="index">
       {{ message }}
       </div>
        <span class = "signup-span">First Name</span><br>
        <input class = "signup-input"
          v-model="firstname"
          name="firstname"
          type="text" required
          placeholder="Enter your first name" 
        /><br>

        <span class = "signup-span">Last Name</span><br>
        <input class = "signup-input"
          v-model="lastname"
          name="lastname"
          type="text" required
          placeholder="Enter your last name" 
        /><br>

        <span class = "signup-span">Username</span><br>
        <input class = "signup-input"
          v-model="username"
          name="username"
          type="text" required
          placeholder="Enter your username" 
        /><br>

        <span class = "signup-span">Email</span><br>
        <input class = "signup-input"
          v-model="email"
          name="email"
          type="email" required
          placeholder="Enter your email" 
        /><br>

        <span class = "signup-span">Password</span><br>
        <input class = "signup-input"
          v-model="password"
          name="password"
          type="password" required
          placeholder="Enter your password" 
        /><br>

        <span class = "signup-span">Birthday</span><br>
        <input class = "signup-input"
          v-model="date_of_birth"
          name="date_of_birth"
          type="date" required
          placeholder="Enter your birthday date"
          min="1950-01-01" max="2023-01-01" 
        /><br>

        <!-- <span class = "signup-span">Profil picture</span><br>
        <input class = "submit-button" type="file" accept="image/*"
        @change="updatePhoto($event.target.name, $event.target.files)"
        /><br> -->
        
        <button type="submit" class = "submit-button" v-on:click="addUser">Sign Up !</button>

        <div v-if="savingSuccessful">
          <div style="color:green;font-size: 20px;">Saving Successful !</div>
          <RouterLink to="/"/>
        </div>
      </form>

  </template>