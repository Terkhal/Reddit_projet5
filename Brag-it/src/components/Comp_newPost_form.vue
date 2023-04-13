<script setup>
import { ref } from "vue"
import Cookie from "js-cookie"
import { useRouter } from "vue-router"
let datas = ref([""])
let titles = ref('')
let contents = ref('')
let user_id = Cookie.get("userid")
let category_id = ref('')
const router = useRouter();

const urlGetCateg = 'http://localhost:8000/api/categories'
let categ = ref([])
fetch(urlGetCateg)
    .then((response) => response.json())
    .then((cat) => {
        //  console.log(cat);
        categ.value = cat
    })
    .catch((error) => {
        console.log("fetch get categ:", error)
    });


function NewPost() {
    console.log("mon id=", user_id);
    console.log("title =", titles.value);
    console.log("content =", contents.value);
    console.log("cat id =", category_id.value);

    fetch("http://127.0.0.1:8000/api/posts", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            title: titles.value,
            content: contents.value,
            user_id: user_id,
            category_id: category_id.value,
            image_path: "",
            is_archived: 0,
        })
    })

        .then((response) => response.json())
        .then((data) => {
            datas.value = data
            router.push('/')
            console.log(datas.value)
        });
}



</script>

<template>
    <div class="CreatForm">
        <h3> Create a new post</h3>
        <table>
            <tr>
                <td> <span> Title </span></td>
                <td><input type="text" name="tite" v-model="titles"></td>
            </tr>
            <tr>
                <td> <span> Content </span></td>
                <td><textarea type="text" name="content" v-model="contents"> </textarea></td>
            </tr>
            <tr>
                <!-- <button class="btn btn-info" @click="onPickFile">Upload profile picture</button>v -->
                <td> <span> Post_path </span></td>
                <td><input type="file" name="post_path" @change="handlefileupload"></td>
            </tr>
            <tr>
                <td> <span> Category </span> </td>
                <td>
                    <span>
                        <select class="dropdown" type="text" name="category" v-model="category_id">
                            <option disabled>Select the category</option>
                            <option class="dropdown-content" v-for="cat in categ" :key="cat.id" :value="cat.id"> {{ cat.name
                            }} </option>
                        </select>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- <RouterLink to="'/category/'+ cat.id" class="topCatLinks">  -->
                    <button v-on:click="NewPost">send</button>
                    <!-- </RouterLink> -->
                    <!-- <a href="/"><input type="button" name="home" value="return to home" style="margin-top: 10px;" class="flatButton"></a> -->
                </td>
            </tr>
        </table>
    </div>
</template>