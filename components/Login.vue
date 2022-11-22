<template>
    <div class="w-1/2 m-4 border-2 rounded-md min-w-[400px]">
        <div class="text-center m-3 text-lg">Login to Continue...</div>
        <div class=" flex flex-col w-1/3 mx-auto min-w-[300px]">
            <input
                class="border-2 border-black rounded-md p-1 text-black m-2 text-center"
                type="text" name="username" placeholder="username" label="Username" v-model="username"
            />
            <input
                class="border-2 border-black rounded-md p-1 text-black m-2 text-center"
                type="password" name="password" placeholder="****" label="Password" v-model="password"
            />
            <div class="text-center mt-3">You're a ?</div>
            <div class="m-2 flex justify-around">
                <div>
                    <input class="m-2" v-model="role" type="radio" name="role" value="User" id="user" checked>  
                    <label for="user">User</label>
                </div>
                <div>
                    <input class="m-2" v-model="role" type="radio" name="role" value="Admin" id="admin">  
                    <label for="admin">Admin</label>
                </div>
            </div>
            <button class="mx-auto bg-blue-400 rounded-lg px-3 py-1 text-white my-4" @click="handleLogin">
                Submit
            </button>
            <NuxtLink to="/register" class="text-sm text-center pb-5 underline text-blue-600">Create a new account.</NuxtLink>   
        </div>
    </div>
</template>

<script setup>
const username = ref('');
const password = ref('');
const role = ref('User');

const handleLogin = () => {
};

</script>