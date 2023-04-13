<script setup>
import {ref} from "vue"
import {useRoute} from "vue-router"
import Cookies from 'js-cookie';




    
const emit = defineEmits('refreshcom') 

let route = useRoute()

const prop = defineProps({
    comid: Number,
})

function deleteComments(){
   

    fetch('http://127.0.0.1:8000/api/comments/' + prop.comid, {
   method: 'DELETE'      
   }).then(function (response) {
   if (response.ok) {
     
       return response.json();
   }
   return Promise.reject(response);
}).then ((data) => {
    emit('refreshcom')

    console.log("prout: ",data.message);
      
}).catch((error) => {
    // emit('creationstatus', error)
   console.warn('invalid query', error);

   
   
});   
}
</script>

<template>

    <button style="margin-left: 100%; border-radius: 10px;" v-on:click="deleteComments" >delete</button>

</template>