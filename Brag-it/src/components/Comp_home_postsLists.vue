<script setup>
import { ref } from "vue"

//recuperation des posts avec un fetch
let datas = ref([])
fetch('https://jsonplaceholder.typicode.com/posts')
    .then(response => response.json())
    .then(data => console.log(datas.value = data))

</script>

<template> 
<div class="posts" v-for="data in datas" :key="data.id">
        <h3>{{ data.title }}</h3><!-- titre du post -->
        <header>
            <p class="user">{{ data.userId }}</p><!-- nom du createur du post -->
            <p class="date">{{data.id}}</p><!-- date de creation du post -->
        </header>
    <div class="content">
        <p>{{ data.body }}</p><!-- le contenue du post -->
    </div>
    
<!-- nombre de commentaire sur le post -->

</div>
</template>

<style>
</style>