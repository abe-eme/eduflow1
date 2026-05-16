<script setup>
import { router, Link } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { ref } from 'vue'

const props = defineProps({
    course: Object,
    lesson: Object,
    lessons: Array,   // IMPORTANT
    nextLesson: Object,
    isCompleted: Boolean,
    canAccess: Boolean
})

const currentLesson = ref(props.lesson)

const completeLesson = () => {

    if (props.isCompleted) return

    router.post(`/lessons/${props.lesson.id}/complete`, {}, {
        preserveScroll: true,
        onSuccess: () => router.reload()
    })
}
</script>

<template>

<div class="min-h-screen bg-gray-100 flex">

    <!-- SIDEBAR LESSON LIST (FIXED MISSING PART) -->
    <div class="w-72 bg-white border-r overflow-y-auto">

        <div class="p-4 border-b">
            <h2 class="font-bold text-gray-800">
                {{ course.title }}
            </h2>
            <p class="text-xs text-gray-500">Lessons</p>
        </div>

        <div>
            <div
                v-for="l in lessons"
                :key="l.id"
                @click="currentLesson = l"
                class="p-3 border-b cursor-pointer hover:bg-gray-100"
                :class="currentLesson.id === l.id ? 'bg-gray-200' : ''"
            >
                <div class="font-medium text-sm">
                    {{ l.title }}
                </div>

                <div class="text-xs text-gray-500">
                    {{ l.type ?? 'text' }}
                </div>
            </div>
        </div>

    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 p-6">

        <h1 class="text-2xl font-bold mb-2">
            {{ currentLesson.title }}
        </h1>

        <p v-if="isCompleted" class="text-green-600 font-semibold mb-3">
            ✔ Completed
        </p>

        <!-- TEXT -->
        <div v-if="!currentLesson.type || currentLesson.type === 'text'">
            {{ currentLesson.content }}
        </div>

        <!-- VIDEO -->
        <div v-else-if="currentLesson.type === 'video'">
            <iframe
                class="w-full h-[400px]"
                :src="currentLesson.content?.replace('watch?v=', 'embed/')"
            />
        </div>

        <!-- IMAGE -->
        <div v-else-if="currentLesson.type === 'image'">
            <img :src="currentLesson.content" />
        </div>

        <!-- ACTION -->
        <div class="mt-6">
            <button
                v-if="!isCompleted"
                @click="completeLesson"
                class="bg-green-600 text-white px-5 py-2 rounded"
            >
                Mark Complete
            </button>

            <button v-else disabled class="bg-gray-400 text-white px-5 py-2 rounded">
                Completed
            </button>
        </div>

    </div>

</div>

</template>