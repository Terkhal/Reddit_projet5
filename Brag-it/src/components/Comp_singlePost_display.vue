<script setup>

import Comp_singlePost_display from "@/components/Comp_singlePost_display.vue";
import comments from "./Comp_singlePost_comments.vue";


import { ref } from "vue"
import { useRoute } from "vue-router"
import Comp_topCat from '../components/Comp_home_topCateg.vue';
//recuperation des posts par id de post avec un fetch
let post = ref([]);
let route = useRoute();
let postId = route.params.post_id;

let url = 'http://127.0.0.1:8000/api/posts/';

fetch(url + postId)
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
        post.value = data;
    });


    function changeform (x){
    let date = new Date(x);
    return date.getDay() + "/" + date.getMonth() +"/"+ date.getFullYear()
}

</script>   

<template>
<Comp_topCat/>
<div class = "display_posts"> 
    <div class="card_post" v-if="post">
        <div>
            <p class="post_date">{{ changeform(post.created_at) }}</p>
            <p class="post_user">{{ post.user_id }}</p>
        </div>
        <h2 class="post_title">{{ post.title }}</h2>
        <div class="post_content">
            <p> {{ post.content }} </p>
        </div>
    </div>
    <comments :catid="post.category_id" />
</div>




    
</template>