<script setup>
import View_home from './views/View_home.vue';
import ThemeButton from "@/components/ThemeButton.vue";

</script>

<template>
<div class="container-center">
  <header>
    <div class="logo"></div> 
    <theme-button/>
    <div class="menu-item"><router-link to="/">Home</router-link></div>
    <div class="menu-item"><router-link to="/about">About</router-link></div>
    <div class="menu-item"><router-link to="/contacts">Contact</router-link></div>
  </header>
<!-- <RouterView/> -->

<body>
  <div class="card">
      <h1>Popular</h1>
      <p>Jordan</p>
      <p>Car</p>
      <p>Pigeon</p>
  </div>

  <View_home/>
</body>

</div>
</template>
