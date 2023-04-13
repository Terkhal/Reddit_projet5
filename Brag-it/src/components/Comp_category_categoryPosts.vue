<script setup>
import { onMounted, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import Comp_home_topCateg from './Comp_home_topCateg.vue';

const route = useRoute();
const urlGetPostByCateg = "http://localhost:8000/api/posts/category/";
let posts = ref([]);
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
    getName(route.params.category_id);
})
function changeform(x) {
    let date = new Date(x);
    return date.getDay() + "/" + date.getMonth() + "/" + date.getFullYear()
}

const urlGetCatName = "http://localhost:8000/api/categories/";
let catName = ref([]);
function getName(value) {
    fetch(urlGetCatName + value)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            catName.value = data
        })
    }
    
getName(route.params.category_id);

</script>

<template>

    <div>
        <Comp_home_topCateg />
    </div>
    <div class="display_posts">

        <div style="display: flex;justify-content: space-around; align-items: center;text-transform: capitalize;">
            <h1 > <span class="value">{{catName.name}}</span> </h1>
       
            <RouterLink :to="'/newpost'">
                <input class="button_newPost" type="button" id="newPost" value="&#10133; Create a post">
            </RouterLink>
            
        </div>


            <div class="card_post" v-for="post in posts" :key="post.id">
                <div v-if="post.user !== undefined">
                    <p class="post_user"> {{ post.user.username }} </p>
                    <p class="post_date"> {{ changeform(post.created_at) }} </p>
                </div>
                <router-link :to="'/post/' + post.id">
                    <h2 class="post_title">{{ post.title }}</h2>
                    <div class="post_content">
                        <p class="post_content_text">{{ post.content }}</p>
                    </div>
                </router-link>
                <router-link :to="'/post/' + post.id">
                    <p class="comment_count"> Comment section : {{ post.comments_count }} &#128172;</p>
                </router-link>
            </div>
        </div> 
    <!-- </div> -->
</template>