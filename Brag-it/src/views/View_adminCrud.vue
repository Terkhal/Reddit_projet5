<script setup>
import {useRoute} from 'vue-router';
import adminmenu from '../components/Comp_admin_menu.vue';
import admincrud from '../components/Comp_adminCrud_crud.vue';
import Cookies from 'js-cookie';
import { useRouter } from 'vue-router'
let cookieadmin = Cookies.get('useradmin');
const router = useRouter()
function verifyadmin(cookieadmin){
if(cookieadmin == 0){
    router.push('/')
}    
}
verifyadmin(cookieadmin);
const route = useRoute();

</script>

<template>
<div class="bodyadmin"  style="display:block">
    <h1>CRUD <span class="value"> {{ route.params.crud }}</span> </h1>
<div class="bodycontentadmin" style="display: flex;">
    <adminmenu />
    <admincrud />

</div>
</div>
</template>

<style>

</style>