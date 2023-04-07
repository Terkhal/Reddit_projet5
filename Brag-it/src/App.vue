<script setup>
import View_home from './views/View_home.vue';
import ThemeButton from "@/components/ThemeButton.vue";
import countcom from './components/Comp_home_topCateg_Count.vue'

// test api

import { ref } from 'vue';

const categ = ref([]);
const posts = ref([]);

fetch('http://127.0.0.1:8001/api/categories')
.then((response) => response.json() )
.then((data) => {console.log(data)
categ.value = data} )




</script>

<template>
<div class="container-center">
  <header>
    <div class="logo"></div> 
    <theme-button/>
  </header>
<!-- <RouterView/> -->

<body>
  <div class="card">
    <div>{{ categ.length }}</div>
    <div v-for="cat in categ">{{ cat.name }}  <countcom :catid="cat.id"/></div>
  </div>

  <!-- <View_home/> -->
</body>

</div>
</template>


