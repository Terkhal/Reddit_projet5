<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";


const route = useRoute();
const Uposts = ref([])

fetch("http://127.0.0.1:8000/api/posts/user/" + route.params.user_id)
    .then(response => response.json())
    .then(data => {
        Uposts.value = data;
        console.log(Uposts.value);
    
    }).catch(error => {
        console.log(error)
    })

    function changeform (x){
    let date = new Date(x);
    return date.getDay() + "/" + date.getMonth() +"/"+ date.getFullYear()
}

console.log("TEST:", Uposts)
</script>

<template>
     <div class="display_posts" style="margin-left: 0;">

<RouterLink :to="'/newpost'">
        <input class="button_newPost" type="button" id="newPost" value="&#10133; Create a post">
</RouterLink>

<div class="card_post" v-for="data in Uposts" :key="data.id">
    

    <router-link :to="'/post/' + data.id">
      <div style="display: flex;justify-content: space-between;">  
     
        <h2 class="post_title">{{ data.title }}</h2>
        <div>
        <p class="post_date"> {{ changeform(data.created_at) }}  </p>
    </div>
    </div>
        <div class="post_content">
            <p class="comment_text">{{ data.content }}</p>
        </div>
    </router-link>
        <div v-if="data.comments_count == undefined">
            <p> {{ data.comments_count }} </p>
        </div>

</div>
</div>
</template>