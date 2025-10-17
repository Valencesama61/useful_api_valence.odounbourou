<template>

<div class="mx-auto justify-center text-center">
    <div v-if="islog">
        Welcome
    </div>
    <div v-else>Module_1 Page</div>
</div>
</template>

<script setup>
   import { AuthStore } from '@/stores/authStore';
   import { storeToRefs } from 'pinia';

   const store = AuthStore();
   const {isLoggedIn}=storeToRefs(store);


   const islog = () =>{
    return isLoggedIn.value;
   }
</script>


<style>
</style>