<script setup> 
import { onMounted, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import Comp_home_topCateg from './Comp_home_topCateg.vue';
const route = useRoute();
const urlGetPostByCateg = "http://localhost:8000/api/posts/category/" ;
let posts = ref ([]);
function getPosts(category_id) {
    fetch(urlGetPostByCateg + category_id)
    .then((response) => response.json())
    .then((post) => {
        console.log(post);
        posts.value = post
    })
}
onMounted(() => {
    getPosts(route.params.category_id)
})
// const watchUrl = ref(route.params.category_id);
watch(() => route.params.category_id, () => {
    getPosts(route.params.category_id);
})
function changeform (x){
    let date = new Date(x);
    return date.getDay() + "/" + date.getMonth() +"/"+ date.getFullYear()
}
</script>
<!-- http://localhost:8000/api/posts/category/1 -->
<template> 
<div>
<Comp_home_topCateg/>   
</div>
<div class="display_posts"> 
        <div class="card_post" v-for="post in posts" :key="post.id">
            <div> 
                <!-- <div v-if="post.category_id == post.id"> -->
                      <p class="post_user"> {{ post.user_id }} </p>
                      <p class="post_date"> {{ changeform(post.created_at) }}  </p>
                      <router-link :to="'/post/' + post.id">
                <h2 class="post_title">{{ post.title }}</h2>
                <div class="post_content">
                    <p class="comment_text">{{ post.content }}</p>
                </div>
            </router-link>
                    </div>
            <!-- <RouterLink :to="'/categories/'+ $route.params.category_id" class="topCatLinks">  -->
                <!-- <div v-if="$route.params.category_id == {{cat.id}}">  -->
                    <!-- <div class="topCatTable_catTitle"> Category {{ cat.id }} <br>  -->
                    <!-- </div>  -->
                <!-- </div> -->
                <!-- </RouterLink> -->
            </div>
            <!-- </div> -->
        </div>
        </template>
