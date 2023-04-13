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
        <form class = "signup">

        <slot />
        <button class="cancel" @click="togglepopup()">Cancel</button>

    </form>
    </div>
</div>


</template>



<style scoped>

</style>