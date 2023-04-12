<script setup>

// import Comp_singlePost_display from "@/components/Comp_singlePost_display.vue";

import { ref } from "vue"
import { useRoute } from "vue-router"
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

</script>   

<template>
    <div class="card_post" v-if="post">
        <div>
            <p class="post_date">{{ post.created_at }}</p>
            <p class="post_user">{{ post.user_id }}</p>
        </div>
        <h2 class="post_title">{{ post.title }}</h2>
        <div class="post_content">
            <p> {{ post.content }} </p>
        </div>
    </div>


    <a href="/"><input type="button" name="home" value="return to home" style="margin-top: 10px;" class="flatButton"></a>
</template>