<template>
<p class="text-center mt-5 text-2xl">Login Page</p>
<div class="mx-auto justify-center text-center mt-10 bg-gray-200 max-w-150">
    <div class="flex flex-col mx-auto justify-center">
        <form @submit.prevent="submit" action="" class="space-y-10 px-3 py-5 flex flex-col">
            <div class="flex flex-col gap-3">
                <label for="email">email</label>
                <input type="email" v-model="email" class="border h-10 rounded-lg p-3">
            </div>
            <div class="flex flex-col gap-3">
                <label for="password">Password</label>
                <input type="password" v-model="password" class="border h-10 rounded-lg p-3">
            </div>
            
            <button @click="submit" class="border bg-blue-400 text-xl text-white h-10 rounded-lg cursor-pointer">{{isSending ? 'Sending' : 'Submit'}}</button>

        </form>
    </div>
</div>
</template>

<script setup>
import { ref } from 'vue';
import { AuthStore } from '@/stores/authStore';
import { storeToRefs } from 'pinia';
import { useRouter } from 'vue-router';

const store = AuthStore();
const {loading} = storeToRefs(store);
const router = useRouter();

const email = ref('');
const password = ref('');



const submit = async () =>{
    const form = {
        'email': email.value,
        'password': password.value,
    }
    await store.login(form);
    //redirection
    router.push('/home')
}

const isSending = () =>{
    return loading.value;
}

   

</script>


<style>
</style>