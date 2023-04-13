<script setup>
import {ref} from "vue"
import {useRoute} from "vue-router"
import Comp_singlepost_form_comments from "./Comp_singlepost_form_comments.vue";

let comments = ref([""])

let route = useRoute()
let postId = route.params.post_id;
let url = 'http://127.0.0.1:8000/api/comments/post/';



fetch(url + postId)
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
        comments.value = data;
        // console.log(comments.content);
    })

</script>

<template>
    {{ contents }}
    <div class="display_posts" v-for="comment in comments"  :key="comment.id">
        <comment> {{ comment.content }} </comment>
        <comment> {{ comment.id }} </comment>
    </div>
    <Comp_singlepost_form_comments :Id="postId"/>
</template>     