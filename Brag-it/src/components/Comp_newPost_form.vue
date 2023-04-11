<script setup>
import {ref} from "vue"

let datas = ref([""])
let titles = ref('')
let contents =ref('')

function NewPost() {

  fetch( "http://127.0.0.1:8000/api/posts", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            title: titles.value,
            content: contents.value,
            user_id: '1',
            category_id: '1',
            image_path: 'this is image',
            is_archived: '0'
        })
    }) 

 .then ((response) => response.json())
 .then ((data) =>{
    datas.value = data
    console.log(datas.value)
 });



}

 

</script>

<template>
    
        <h2>Creat a New Post</h2>
        <div>
            <label for="name">Title:
                <input type="text" class="title-post" placeholder="Title" v-model="titles">    
            </label>
        </div>
        <div>
            <label for="name">Content:
                <input type="text" class="content-post" placeholder="content" v-model="contents">    
            </label>
        </div>
        <div>
            <label for="name">Picture:
                <input type="image" id="name">    
            </label>
        </div>
        <div>
            <button v-on:click="NewPost">send</button>
            <a href="/"><input type="button" name="home" value="return to home" style="margin-top: 10px;" class="flatButton"></a>
        </div>
        

</template>