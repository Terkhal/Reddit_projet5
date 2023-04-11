<script setup>
import { ref} from "vue"
import {useRoute} from "vue-router"
//recuperation des posts par id de post avec un fetch
let post = ref([]);
let route = useRoute();
let postId = route.params.post_id;

 let url = 'http://127.0.0.1:8000/api/posts/';

fetch( url + postId)    
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
        post.value = data;
    }); 
    
</script>   

<template>
    <div class="card" v-if="post">
        <h3>{{post.title}}</h3>
        <p>{{post.content}}</p>
    </div>
    
    <a href="/"><input type="button" name="home" value="return to home" style="margin-top: 10px;" class="flatButton"></a>
</template>