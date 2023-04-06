<script setup>

function NewPost() {

    let bodys = {
        title: this.title, 
        content: [this.content],
        category: this.category,
        imagepath: this.imagepath,
    }

    fetch( "https://jsonplaceholder.typicode.com/posts", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({bodys}),
    })

    .then ((response) => response.json())
    .then ((data) => console.log(data));
}

</script>

<template>
    <form>
        <h2>Creat a New Post</h2>
        <div>
            <label for="name">Title:
                <input type="text" id="name">    
            </label>
        </div>
        <div>
            <label for="name">Content:
                <input type="text" id="name">    
            </label>
        </div>
        <div>
            <label for="name">Picture:
                <input type="image" id="name">    
            </label>
        </div>
        <div>
            <button @click="NewPost">send</button>
        </div>
        
       
    </form>
</template>