<script setup>
import adminmenu from '../components/Comp_admin_menu.vue'
import Cookies from 'js-cookie';
import { useRouter } from 'vue-router'
import index from '../components/Comp_admin_stat.vue'
let cookieadmin = Cookies.get('useradmin');
const router = useRouter()

function verifyadmin(cookieadmin){
    console.log('am i admin: ', cookieadmin )
if(cookieadmin && cookieadmin == false){
    router.push('/')
}}
verifyadmin(cookieadmin);


</script>

<template>
<div class="bodyadmin"  style="display:block">
    <h1>INDEX </h1>
<div class="bodycontentadmin" style="display: flex;">
    <adminmenu />
    <div  style="display: block;width: -webkit-fill-available;">
    <index />
            <!-- chartjs will be here -->

</div>
</div>
</div>
</template>
<style>
.menu{
    background-color: white;
}

</style>