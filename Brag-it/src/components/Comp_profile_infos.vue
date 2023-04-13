<script setup>
  import Cookies from 'js-cookie';
  import { ref, onMounted } from 'vue'
  import { useRoute,useRouter } from 'vue-router';
      
  const route = useRoute();
  const router = useRouter();
  const user = ref({})

  
    const fetchUser = () => {
    
        fetch(`http://127.0.0.1:8000/api/users/` + route.params.user_id)
          .then(response => response.json())
          .then(data => {
            user.value = data
          })
          .catch(error => {
            console.log(error)
          })
    }
      
  const saveUser = () => {

        fetch(`http://127.0.0.1:8000/api/users/` + route.params.user_id, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(user.value)
        })
          .then(response => response.json())
          .then(data => {
            console.log('User saved:', data)
          })
          .catch(error => {
            console.log(error)
          })
      }
      
    onMounted(() => {
      fetchUser()
    })

  const currCookie = Cookies.get('userid');

    if (route.params.user_id != currCookie) {
    router.push('/');
    }
</script>

<template>

    <div>
      <h1>Edit your profile</h1>
      <form class = "edit-profile" @submit.prevent="saveUser">
        <span class = "signup-span">Firstname:</span>
        <input class = "signup-input" v-model="user.firstname" type="text" />
        <br>
        <span class = "signup-span">Lastname:</span>
        <input class = "signup-input" v-model="user.lastname" type="text" />
        <br>
        <span class = "signup-span">Username:</span>
        <input class = "signup-input" v-model="user.username" type="text" />
        <br>
        <span class = "signup-span">Email:</span>
        <input class = "signup-input" v-model="user.email" type="email" />
        <br>
        <span class = "signup-span">Password:</span>
        <input class = "signup-input" v-model="user.password" type="text" />
        <br>
        <button class="confirm" type="submit">Save</button>
      </form>
    </div>
  </template>