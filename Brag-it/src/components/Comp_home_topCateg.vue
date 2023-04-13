<script setup>
import { ref } from 'vue';
// import {useRoute} from "vue-router";


////////////////////// get all categories:

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

</script>

<template>
    <table class="topCatTable">
                <h2> &#128293; CATEGORIES </h2>
            <tr  v-for="cat in categ" :key="cat.id">
                <RouterLink :to="'/category/'+ cat.id" class="topCatLinks"> 
                    <div class="topCatTable_catTitle"> Category {{ cat.name }} <br> 
                    </div> 
                </RouterLink>
                <!-- <div class="topCatTable_catInfo"> 10 Posts, &#128172; 10 comments </div> -->
                <br>
                </tr>         
        </table> 
</template>

