<script setup> 
import { onMounted, ref, watch } from 'vue';
import { useRoute } from 'vue-router';

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


</script>
<!-- http://localhost:8000/api/posts/category/1 -->
<template> 
<div> coucou la vue par categorie !!</div>
        <div v-for="post in posts" :key="post.id">
                <!-- <div v-if="post.category_id == post.id"> -->
                        title of the post: {{ post.title }} 
            <!-- <RouterLink :to="'/categories/'+ $route.params.category_id" class="topCatLinks">  -->

                <!-- <div v-if="$route.params.category_id == {{cat.id}}">  -->
                    <!-- <div class="topCatTable_catTitle"> Category {{ cat.id }} <br>  -->
                    <!-- </div>  -->
                <!-- </div> -->
                <!-- </RouterLink> -->
            </div>
            <!-- </div> -->
        </template>