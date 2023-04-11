<script setup>
// import Comp_home_postsLists from '../components/Comp_home_postsLists.vue';
import Comp_topCat from '../components/Comp_home_topCateg.vue';


</script>

<template>
    <a href="/newpost"><input type="button" name="newPost" value="New Post" style="margin-top: 10px;" class="flatButton"></a>

    
    
    <Comp_home_postsLists/>
   
</template>

<style> 
.categ{
  float: left;
}
</style>