<script setup>

</script>

<template>
    <div class="adminmenu">
        <div class="titlemenu"><h2 class="divmenu" ><u>Dashboard</u></h2>
     </div>
          <div class="contentmenu">
         <RouterLink :to="'/admin'"><div > Index        </div></RouterLink>  
            <RouterLink :to="'/admin/users'"> <div> Users        </div></RouterLink>  
                <RouterLink :to="'/admin/posts'"><div> Posts        </div></RouterLink>  
                    <RouterLink :to="'/admin/categories'"><div > Categories   </div></RouterLink>  
                        <RouterLink :to="'/admin/comments'"><div> Comments      </div></RouterLink>  
                    </div>
    </div>
</template>


