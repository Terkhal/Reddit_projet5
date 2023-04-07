<script setup>
import { ref } from 'vue';
import {useRoute} from "vue-router";

////////////////////// get comments of all posts by post id:

const urlGetCateg = 'http://localhost:8000/api/categories'
let categ = ref ([])
// const route = useRoute();
//    let categId = $route.params.id;
//get mes catégories
    fetch(urlGetCateg)
        .then((response) => response.json())
        .then((cat) => {
            //  console.log(cat);
             categ.value = cat
            })
            // eslint-disable-next-line no-unused-vars
            .catch((error) => {
                console.log(error)
            });
            // console.log(this.categId);   


        // console.log(this.$route.params.id);
 
///////////////////////////////// get all posts 


// const urlGetPost = 'http://localhost:8000/api/posts'
// let posts = ref ([])

// fetch(urlGetPost)
//         .then((response) => response.json())
//         .then((post) => {
//              console.log(post);
//              posts.value = post
//         })



///////////////////////////// get all comments 

//         const urlGetComment = 'http://localhost:8000/api/comments'
//         let comments = ref ([])

// fetch(urlGetComment)
//         .then((response) => response.json())
//         .then((data) => {
//             //  console.log(data);
//              comments.value = data
//         })

//     // console.log('this are all com=>',comments)




</script>

<template>
    <p> {{ $route.params.id  }}</p>
        <table class="topCatTable">
                <h2> &#128293; POPULAR </h2>
            <tr  v-for="cat in categ" :key="cat.id">
                <a class = "topCatLinks" href="#"> 
                    <div class="topCatTable_catTitle"> Category {{ cat.name }} <br> 
                    </div> 
                </a>
                <div class="topCatTable_catInfo"> 10 Posts, &#128172; 10 comments </div>
                <br>
                </tr>         
                <br>
        </table>
</template>

