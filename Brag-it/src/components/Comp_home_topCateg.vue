<script setup>
import { onMounted, ref } from 'vue';

let ID = ref([])
const url = 'https://jsonplaceholder.typicode.com/comments?_limit=10'

onMounted(() => {
    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            let tmp = data.map(comments => comments.postId)
            //   comments.value = data
            let result = {}
            tmp.forEach(function (x) { result[x] = (result[x] || 0) + 1; });
            ID.value = result
            console.log(ID)
        })
        // eslint-disable-next-line no-unused-vars
        .catch((error) => {
            console.log(error)
            console.error('oulaaah erreur')
        })
})

console.log();

Math.max(ID){
    const max = arr.reduce((a, b) => Math.max(a, b), -Infinity);
    const max = arr.reduce((a, b) => Math.max(a, b), -Infinity);

}
function topPost (ID)

</script>

<template>
    <div class="categ">

        <table class="topcat">
            <p> test ci dessous</p>
            <div v-if="ID.value != undefined">
                <div v-for="comment in comments.postId" :key="comment.postId">
                </div>
            </div>

            <tr>
                <th> &#128293; POPULAR </th>
            </tr>
            <tr>
                <td> TOP VALUE {{ ID }} </td>
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