<script setup>

import { useRoute } from 'vue-router'

const route = useRoute();


const emit = defineEmits(['refresheded','creationstatus3'])


const prop = defineProps({
    toggleforms:{
        type: Function,
    },
    id: {
        type: Number,
    },
    name: {
        type: String,
    }

})

function deleteData() {
   

   
   fetch('http://127.0.0.1:8000/api/' + route.params.crud + '/' + prop.id, {
   method: 'DELETE'      
   }).then(function (response) {
   if (response.ok) {
     
       return response.json();
   }
   return Promise.reject(response);
}).then ((data) => {
    emit('creationstatus3', data.message)
    emit('refresheded')
    prop.toggleforms();
    console.log("prout: ",data.message);
      
}).catch((error) => {
    // emit('creationstatus', error)
   console.warn('invalid query', error);

   
   
});

 }





</script>

<template>
<div class="popup">
    <div class="popup-inner">
<h3> Are you sure ?</h3>
<p> you are about to delete : <br /> <span class="value">{{ name }} </span> from <span class="value">{{ route.params.crud }} </span> </p>
<div>       

            
               
     <button class="confirm"  v-on:click="deleteData">Confirm</button>
     <button class="cancel" @click="toggleforms()">Cancel</button>
        
        
    </div>
       
      
    </div>
</div>


</template>

<style scoped>



</style>

