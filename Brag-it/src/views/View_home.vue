<script setup>
import Comp_home_postsLists from '../components/Comp_home_postsLists.vue';
import Comp_topCat from '../components/Comp_home_topCateg.vue';


</script>

<template>

    <!-- <div class="grid">  -->
    <div class="bodycontentadmin"> 
    <Comp_topCat/>
    <Comp_home_postsLists/>
    </div>
  <!-- </div> -->
</template>

<style> 
.categ{
  float: left;
}
</style>