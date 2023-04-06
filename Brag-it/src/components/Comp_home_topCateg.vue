<script setup>
import { onMounted, ref } from 'vue';


// get comments of all posts by post id:

let postComment = ref([])
const urlGetComments = 'https://jsonplaceholder.typicode.com/comments?_limit=10'

onMounted(() => {
    fetch(urlGetComments)
        .then((response) => response.json())
        .then((data) => {
            let tmp = data.map(comments => comments.postId)

// group comments by post id:
            let result = {}
            tmp.forEach(function (x) { result[x] = (result[x] || 0) + 1; });
            postComment.value = result
            console.log(postComment)
        })
        // eslint-disable-next-line no-unused-vars
        .catch((error) => {
            console.log(error)
            console.error('oulaaah erreur')
        })
})



// get comments of all categories 


let category = ref([])
//adapter url
const urlGetCateg = 'https://jsonplaceholder.typicode.com/comments?_limit=10'
onMounted(() => {
    fetch(urlGetCateg)
        .then((response) => response.json())
        .then((data) => {
            category.value = data})
            console.log(category)
        })
        // eslint-disable-next-line no-unused-vars
        .catch((error) => {
            console.log(error)
            console.error('oulaaah erreur')
        })


// Math.max(ID)

</script>

<template>
    <div class="categ">

        <table class="topcat">
            <p> test ci-dessous</p>
            <div v-if="ID.value != undefined">
                <div v-for="comment in comments.postId" :key="comment.postId">
                </div>
            </div>

            <tr>
                <th> &#128293; POPULAR </th>
            </tr>
            <tr>
                <td> {{ ID }} </td>
            </tr>
            <tr>
                <td> categ 2 </td>
            </tr>
            <tr>
                <td> categ 3 </td>
            </tr>
        </table>
    </div>

</template>

<style>
th,
td {
    border-color: #020202;
}

/* 
.categ{
    float:left;
} */

/* .topcat{
    background-color: blueviolet;
 }  */
</style>