<script setup>
import { ref } from 'vue';


////////////////////// get all categs:

const urlGetCateg = 'http://localhost:8000/api/categories'
let categ = ref ([])

    fetch(urlGetCateg)
        .then((response) => response.json())
        .then((cat) => {
            //  console.log(cat);
             categ.value = cat
            })
            // eslint-disable-next-line no-unused-vars
            .catch((error) => {
                console.log("fetch get categ:", error)
            });
            // console.log(this.categId);   

 
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


//Math.max(ID){
//    const max = arr.reduce((a, b) => Math.max(a, b), -Infinity);
//    const max = arr.reduce((a, b) => Math.max(a, b), -Infinity);
//}


</script>

<template>
    <table class="topCatTable">
                <h2> &#128293; POPULAR </h2>
            <tr  v-for="cat in categ" :key="cat.id">
                <RouterLink :to="'/category/'+ cat.id" class="topCatLinks"> 
                    <div class="topCatTable_catTitle"> Category {{ cat.name }} <br> 
                    </div> 
                </RouterLink>
                <div class="topCatTable_catInfo"> 10 Posts, &#128172; 10 comments </div>
                <br>
                </tr>         
        </table>
</template>

