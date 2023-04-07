<script setup>
import View_home from './views/View_home.vue';
import ThemeButton from "@/components/ThemeButton.vue";
import Comp_app_login from "@/components/Comp_app_login.vue";
</script>

<template>
<div class="container-center">

  <header>
  <div class="logo"></div>
  <theme-button/>
  <div class="logo-search"></div>

  <div class="bar-search">
  <input type="text" v-model="search" placeholder="Search..."/>
  </div>
  <div><a href="" >signup</a></div>
  <Comp_app_login/>
  </header>
<body>
  <div class="card">
      <h1>Popular</h1>
      <p>Jordan</p>
      <p>Car</p>
      <p>Pigeon</p>
  </div>
  <View_home/>
  <RouterView/>
</body>

</div>
</template>
