    <script setup>
    // import { text } from "stream/consumers";
    import {ref} from "vue"
    import {useRoute, useRouter } from "vue-router"
    import Cookies from 'js-cookie';
    let user_id = Cookies.get('userid');


    const emit = defineEmits('refreshcom') 

    let comments = ref([])
    let content = ref("")

    let route = useRoute();
    const router = useRouter;
    let postId = route.params.post_id;

    let url = 'http://127.0.0.1:8000/api/comments/';
    const creatcomment = defineProps({
        Id:{
            type: Number,
        },
        catidform:{
            type: Number,
        }
    }) 


    function Creatcomment(){
        console.log(comments.value);
        console.log('com',content.value);
        console.log('userid',user_id);
        console.log('postid',creatcomment.Id);
        console.log('category',creatcomment.catidform);
        console.log('is_sub_com', 1);
        console.log('reply_to', 0);
        console.log('is_archived',0);
        


        fetch(url,{
            method:"POST",
            headers:{"content-Type":"application/json; charset=UTF-8" },
            body: JSON.stringify({
                    content: content.value,
                    post_id: creatcomment.Id,
                    user_id: user_id,
                    category_id: creatcomment.catidform,
                    is_archived: 0,
                    is_sub_com: 0,  
                    reply_to: 0, //l'id du commentaire 
                        
                })
        })
        .then((response)=>response.json())
        .then((data)=>{
            console.log(comments.value);
            comments.value=data;
            console.log('jesuisla');  
            emit('refreshcom');
        
                // emit('tamere',prout);
            

        })
    }

    </script>

    <template>
     
        <div style="text-align: center;">
            <h4>comment</h4>
            <textarea  type="text" name="content" v-model="content"></textarea>
            <button  v-on:click="Creatcomment" >send</button>
        </div>
    </template>     