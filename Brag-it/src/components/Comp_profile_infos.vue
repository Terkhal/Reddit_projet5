<script setup>
  import Cookies from 'js-cookie';
  import { ref, onMounted } from 'vue'
  import { useRoute } from 'vue-router';
      
  const route = useRoute()
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
      //   useRoute.push({ path: '/' })
      console.log("HEEELLLOOOO");
      
    }

</script>

<template>
{{ route.params.user_id }}
{{ currCookie }}
    <div>
      <form @submit.prevent="saveUser">
        <label>
          Firstame:
          <input v-model="user.firstname" type="text" />
        </label>
        <br>
        <label>
          Lastname:
          <input v-model="user.lastname" type="text" />
        </label>
        <br>
        <label>
          Username:
          <input v-model="user.username" type="text" />
        </label>
        <br>
        <label>
          Email:
          <input v-model="user.email" type="email" />
        </label>
        <br>
        <label>
          Password:
          <input v-model="user.password" type="text" />
        </label>
        <br>

        <button type="submit">Save</button>
      </form>
    </div>
  </template>
  
  
  