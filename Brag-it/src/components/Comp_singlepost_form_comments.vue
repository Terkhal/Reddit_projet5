<script setup>
// import { text } from "stream/consumers";
import {ref} from "vue"
import {useRoute} from "vue-router"

let comments = ref([])
let content = ref("")
let user_id = ref(1)
let route = useRoute()
let postId = route.params.post_id;

let url = 'http://127.0.0.1:8000/api/comments/';
 const creatcomment = defineProps({
    Id:{
        type: Number,
    }
}) 


function Creatcomment(){
    console.log(comments.value);
    console.log('com',content.value);
    console.log('userid',user_id.value);
    console.log('postid',creatcomment.Id);

    fetch(url,{
        method:"POST",
        headers:{"content-Type":"application/json; charset=UTF-8" },
        body: JSON.stringify({
                content: content.value,
                post_id: creatcomment.Id,
                user_id: user_id.value,
                is_archived: 0,
                is_sub_com: 0,  
                reply_to: 0, //l'id du commentaire 
                      
            })
    })
       .then((response)=>response.json())
       .then((data)=>{
           console.log(comments.value);
           comments.value=data
       })
}

</script>

<template>
    <div class="display_posts">
        <input type="text" name="content" v-model="content">
        <button v-on:click="Creatcomment">send</button>
    </div>
</template>     