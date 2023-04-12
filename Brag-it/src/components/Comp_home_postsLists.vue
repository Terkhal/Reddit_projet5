<script setup>
import { ref } from "vue";
import { RouterLink } from "vue-router";
// import Dayjs from 'vue-dayjs';



//recuperation des posts avec un fetch
let datas = ref([])
fetch('http://127.0.0.1:8000/api/posts')
    .then(response => response.json())
    .then(data => console.log(datas.value = data))

</script>

<template>
    <div class="display_posts">

        <RouterLink :to="'/newpost'">
            
                <input class="button_newPost" type="button" id="newPost" value="&#10133; Create a post">
            
        </RouterLink>


        <div class="card_post" v-for="data in datas" :key="data.id">

            <div>
                <p class="post_user">{{ data.user_id }} </p>
                <p class="post_date"> {{ data.created_at  }}  </p>
            </div>

            <!-- | dayjs('YYYY-MM-DD') -->

            <router-link :to="'/post/' + data.id">
                <h2 class="post_title">{{ data.title }}</h2>
                <div class="post_content">
                    <p class="comment_text">{{ data.content }}</p>
                </div>
            </router-link>
                <div v-if="data.comments_count == undefined">
                    <p> je teste ici: {{ data.comments_count }} fin </p>
                </div>

        </div>
    </div>
</template>

<style></style>