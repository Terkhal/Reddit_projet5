<script setup>
import { ref } from "vue"

//recuperation des posts avec un fetch
let datas = ref([])
fetch('http://127.0.0.1:8000/api/posts')
    .then(response => response.json())
    .then(data => console.log(datas.value = data))

</script>

<template>

<div class="card" v-for="data in datas" :key="data.id">
    <router-link :to="'/post/' + data.id">
        <h3>{{ data.title }}</h3><!-- titre du post -->
        <header>
            <p class="date">{{data.user_id}}</p><!-- date de creation du post -->
            <p class="user">{{ data.created_at }}</p><!-- nom du createur du post -->
        </header>
        <div class="content">
            <p>{{ data.content }}</p><!-- le contenue du post -->
        </div>
<!-- nombre de commentaire sur le post -->
    </router-link>

</div>

</template>

<style>
</style>