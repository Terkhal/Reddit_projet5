<script setup>
import {ref} from "vue";
import {useRoute} from "vue-router";
import Comp_singlepost_form_comments from "./Comp_singlepost_form_comments.vue";
import Comp_singlePost_delete_comments from "./Comp_singlePost_delete_comments.vue";
import Cookies from 'js-cookie';


let user_id = Cookies.get('userid');


let comments = ref([""])
let route = useRoute()
let postId = route.params.post_id;
let url = 'http://127.0.0.1:8000/api/comments/post/';

const prop = defineProps({
    catid: Number,
})

function fecthcom() {
    fetch(url + postId)
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
        comments.value = data;
        // console.log(comments.content);
    })
    
}

fecthcom();
</script>

<template>

  
    <div class="card_post"  v-for="comment in comments"  :key="comment.id">
        <p> {{ comment.content }} </p>   
        
        <Comp_singlePost_delete_comments v-if="user_id == comment.user_id" :comid="comment.id" @refreshcom="fecthcom"/>
    </div>
    <Comp_singlepost_form_comments :Id="postId" :catidform="catid" @refreshcom="fecthcom"/>
</template>     