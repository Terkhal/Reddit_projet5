<script setup>
import View_home from './views/View_home.vue';
import ThemeButton from "@/components/ThemeButton.vue";

</script>

<template>
<div class="container-center">
  <header>
    <div class="logo"></div> 
    <theme-button/>
  </header>
<!-- <RouterView/> -->

<body>
  <View_home/>
</body>

</div>
</template>


