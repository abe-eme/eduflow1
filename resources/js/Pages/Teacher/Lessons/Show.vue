<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { ref } from 'vue'

const props = defineProps({
    course: Object,
    lessons: Array,
    lesson: Object
})

const currentLesson = ref(props.lesson)
</script>

<template>
<AdminLayout>

<div class="h-screen flex">

    <!-- SIDEBAR (UPDATED BACKGROUND) -->
    <div class="w-72 bg-slate-100 border-r overflow-y-auto">

        <!-- HEADER -->
        <div class="p-4 bg-slate-200 border-b">
            <h1 class="text-sm font-semibold text-gray-800">
                {{ course.title }}
            </h1>
            <p class="text-xs text-gray-600">Lessons</p>
        </div>

        <!-- LESSON LIST -->
        <div>

            <div
                v-for="l in lessons"
                :key="l.id"
                @click="currentLesson = l"
                class="px-4 py-3 cursor-pointer border-b transition"
                :class="currentLesson.id === l.id
                    ? 'bg-white border-l-4 border-blue-600'
                    : 'hover:bg-slate-200'"
            >

                <div class="text-sm font-medium text-gray-800">
                    {{ l.title }}
                </div>

                <div class="text-xs text-gray-500">
                    {{ l.type }}
                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 bg-white overflow-y-auto">

        <!-- TOP BAR -->
        <div class="border-b px-6 py-3 text-xs text-gray-500">
            Lesson Viewer
        </div>

        <!-- CONTENT AREA -->
        <div class="max-w-3xl mx-auto p-8">

            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                {{ currentLesson.title }}
            </h1>

            <p class="text-xs text-gray-400 mb-6">
                {{ currentLesson.type }}
            </p>

            <!-- TEXT -->
            <div v-if="currentLesson.type === 'text'" class="text-gray-800 leading-7 whitespace-pre-line">
                {{ currentLesson.content }}
            </div>

            <!-- VIDEO -->
            <div v-else-if="currentLesson.type === 'video'" class="aspect-video">

                <iframe
                    v-if="currentLesson.content.includes('youtube')"
                    :src="currentLesson.content.replace('watch?v=', 'embed/')"
                    class="w-full h-full"
                    frameborder="0"
                    allowfullscreen
                ></iframe>

            </div>

            <!-- IMAGE -->
            <div v-else-if="currentLesson.type === 'image'">
                <img :src="currentLesson.content" class="rounded-md max-w-full" />
            </div>

        </div>

    </div>

</div>

</AdminLayout>
</template>