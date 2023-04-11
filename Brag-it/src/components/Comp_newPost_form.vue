<script setup>
import {ref} from "vue"

let datas = ref([""])
let titles = ref('')
let contents =ref('')
let user_id =ref(null)

function NewPost() {

  fetch( "http://127.0.0.1:8000/api/posts", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            title: titles.value,
            content: contents.value,
            user_id: user_id.value,
            category_id: category_id.vcalue,
            image_path: image_path.value,
            is_archived:  is_archived.value,
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
<div class="CreatForm">
    <h3> Create a new post</h3>
        <table>
            <tr>
                <td>Title</td>
                <td><input type="text" name="tite"
                    v-model="titles"></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><input type="text" name="content" v-model="contents"></td>
            </tr>
            <tr>
                <!-- <button class="btn btn-info" @click="onPickFile">Upload profile picture</button>v -->
                <td>Post_path</td>
                <td><input type="file" name="post_path"  @change="handlefileupload"></td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                <select class="seleccatgory" type="text" name="category" v-model="category_id">
                <option disabled value="category_id">Select the category</option>
                <!-- <option value="1">Yes</option>
                <option  value="0">No</option> -->
                </select>
                </td>
            </tr>
            <tr>
                <td>
                    <button v-on:click="NewPost">send</button>
                    <a href="/"><input type="button" name="home" value="return to home" style="margin-top: 10px;" class="flatButton"></a>
                </td>
            </tr>
       
        </table>
</div>
    

           
        

</template>