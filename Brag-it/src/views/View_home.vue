<script setup>
import Comp_topCat from '../components/Comp_home_topCateg.vue';
import Comp_home_postsLists from '../components/Comp_home_postsLists.vue';

</script>

<template>
<!-- include nav barre -->
<!-- include top cat -->
<!-- include add post -->
<!-- include post liste -->
<div class="categ">
  <Comp_topCat/>
 </div>
  
    <Comp_home_postsLists/>

</template>

<style> 
.categ{
  float: left;
}
</style>