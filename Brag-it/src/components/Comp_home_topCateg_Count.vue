<script setup>
import {ref} from 'vue'
    const props = defineProps({
        catid:{
            type: Number
        }
    })


    let count = ref()
fetch('http://127.0.0.1:8001/api/comments/category/' + props.catid )
.then((response) => response.json() )
.then((data) => {console.log(data)
count.value = data} )
    </script>

    <template>
       <div>there is: {{ count.length }} comments</div> 
    </template>