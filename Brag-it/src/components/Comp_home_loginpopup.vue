<script setup>

const prop = defineProps({
    togglepopup:{
        type: Boolean,
    }
})
</script>

<template>
<div class="popup">
    <div class="popup-inner">
        
        <slot />
        <button @click="togglepopup()">Cancel</button>
    </div>
</div>


</template>



<style scoped>

</style>