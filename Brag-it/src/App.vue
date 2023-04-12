<script setup>
/* import View_home from './views/View_home.vue'; */
import ThemeButton from "@/components/ThemeButton.vue";
import Comp_app_login from "@/components/Comp_app_login.vue";
import {ref, onMounted} from 'vue';

let toggledisplay = ref(false)
function verify(value){
  toggledisplay.value = value
}
</script>

<template>
<div class="container-center">

  <header>
  <div class="logo"></div>
  <div class="bar-search">
  <div class="logo-search"></div>
  <input  class="bar-search-input" type="text" v-model="search" placeholder="Search..."/>
  
</div>
  <Comp_app_login @isloggedin="verify"/>
  <theme-button/>

  </header>
<body v-if="toggledisplay">

    <!-- <View_home/> -->
  <RouterView/>




</body>
<body class="dcbody" v-if="!toggledisplay">
  <h1>Not connected</h1>
  <h2>You must be logged in and over 13 to view this webside</h2>
</body>
</div>
</template>

<style>
.dcbody{
  display:block;
  text-align: center;
  margin-top: 200px;
}
</style>
