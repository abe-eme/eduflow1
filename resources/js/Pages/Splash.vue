<script setup>
import { onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

onMounted(() => {
    setTimeout(() => {
        router.visit('/login')
    }, 1500)
})
</script>

<template>
<div class="h-screen flex items-center justify-center bg-blue-600 text-white text-2xl">
    Loading...
</div>
</template>