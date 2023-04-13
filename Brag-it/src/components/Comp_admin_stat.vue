<script setup>

import { ref } from 'vue';


let stat = ref()
let url = "http://127.0.0.1:8000/api/data";


function gofetchdata() {
 
  return fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      stat.value = data;
      return data;
    })
    .catch((error) => {
      console.error(error);
      return null;
    });
}

gofetchdata()

</script>



<template>
<div style=";width: 100%;;">

<div v-if="stat !== undefined" style="display: flex;width: 100%;justify-content: space-between;margin: 20px;">
    <h1 v-if="stat.users  !== undefined">Users: <span class="value"> {{ stat.users }}</span></h1>
    <h1 v-if="stat.admin_users  !== undefined">admin: <span class="value">{{ stat.admin_users }}</span></h1>
    <h1 v-if="stat.posts  !== undefined">Posts:<span class="value"> {{ stat.posts }}</span></h1>
    <h1 v-if="stat.categories  !== undefined">Categories:<span class="value"> {{ stat.categories }}</span></h1>
    <h1 v-if="stat.comments  !== undefined">Comments:<span class="value">{{ stat.comments }}</span></h1>
</div>h1

</div>
</template>

