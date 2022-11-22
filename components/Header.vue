<template>
    <div class="w-full py-5 px-12 text-lg bg-gray-400 text-white">
        <div class="w-fit mx-auto text-2xl">Organization DMS</div>
        <div class="w-fit ml-auto text-md" v-if="state">
            <div class="hover:bg-white rounded-lg px-3 py-1 hover:text-gray-400 hover:underline cursor-pointer" @click="logout">
                {{state.text}}
            </div>
        </div>
    </div>
</template>

<script setup>
const {state} = defineProps(['state']); 
</script>