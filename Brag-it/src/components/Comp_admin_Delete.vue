<script setup>



const emit = defineEmits(['refresheded','creationstatus3'])


const prop = defineProps({
    toggleforms:{
        type: Function,
    },
    userid: {
        type: Number,
    }

})

function deleteUser() {
   

   
   
   fetch('http://127.0.0.1:8000/api/users/' + prop.userid, {
   method: 'DELETE'      
   }).then(function (response) {
   if (response.ok) {
     
       return response.json();
   }
   return Promise.reject(response);
}).then ((data) => {
    emit('creationstatus3', data.message)
    emit('refresheded')
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
        <table class="deletetable">
      
            <tr>
                
                <td> <button class="confirm" @click="toggleforms()"  v-on:click="deleteUser()">Delete</button>
                    <button class="cancel" @click="toggleforms()">Cancel</button></td>
             
            </tr>
        </table>
     
       
      
    </div>
</div>


</template>

<style scoped>


td{
    border:none;
}
</style>

