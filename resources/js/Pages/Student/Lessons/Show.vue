<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
    lesson: Object
})

const embed = (url) => {
    if (!url) return ''
    return url.replace('watch?v=', 'embed/')
}
</script>

<template>
<AdminLayout>

<div class="p-8 max-w-5xl mx-auto space-y-6">

    <!-- TITLE -->
    <h1 class="text-3xl font-bold text-gray-800">
        {{ lesson.title }}
    </h1>

    <!-- TEXT -->
    <div v-if="lesson.type === 'text'" class="text-gray-700 leading-relaxed bg-white p-6 rounded-2xl shadow">
        {{ lesson.content }}
    </div>

    <!-- VIDEO -->
    <div v-else-if="lesson.type === 'video'" class="bg-black rounded-2xl overflow-hidden shadow-lg">
        <iframe
            class="w-full h-[500px]"
            :src="embed(lesson.content)"
            allowfullscreen
        ></iframe>
    </div>

    <!-- IMAGE -->
    <div v-else-if="lesson.type === 'image'" class="bg-white p-4 rounded-2xl shadow">
        <img :src="lesson.content" class="w-full rounded-xl" />
    </div>

    <!-- EMPTY -->
    <div v-else class="text-center text-gray-500 bg-gray-50 p-10 rounded-2xl">
        No content available
    </div>

</div>

</AdminLayout>
</template>