<script setup>
import { ref } from "vue";
import { RouterLink } from "vue-router";
// import Dayjs from 'vue-dayjs';



//recuperation des posts avec un fetch
let datas = ref([])
fetch('http://127.0.0.1:8000/api/posts')
    .then(response => response.json())
    .then(data => {datas.value = data;
                    console.log(datas.value);
                })

function changeform (x){
    let date = new Date(x);
    return date.getDay() + "/" + date.getMonth() +"/"+ date.getFullYear()
}

console.log("le test est là",  datas)

</script>

<template>
    <div class="display_posts">

        <RouterLink :to="'/newpost'">
                <input class="button_newPost" type="button" id="newPost" value="&#10133; Create a post">
        </RouterLink>

        <div class="card_post" v-for="data in datas" :key="data.id">
            <div>
                <p class="post_user">{{ data.user_id }} </p>
                <p class="post_date"> {{ changeform(data.created_at) }}  </p>
            </div>

            <router-link :to="'/post/' + data.id">
                <h2 class="post_title">{{ data.title }}</h2>
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

<style></style>