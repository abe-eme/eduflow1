<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
    course: Object,
    quizzes: Array
})
</script>

<template>
<AdminLayout>

<div class="max-w-5xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">
            Quizzes
        </h1>

        <Link
            :href="`/teacher/courses/${course.id}`/quizzes/create"
            class="bg-blue-600 text-white px-4 py-2 rounded"
        >
            + Create Quiz
        </Link>

    </div>

    <div
        v-for="quiz in quizzes"
        :key="quiz.id"
        class="bg-white border rounded-xl p-5 mb-4"
    >

        <h2 class="text-xl font-bold">
            {{ quiz.title }}
        </h2>

        <p class="text-gray-600 mt-2">
            {{ quiz.description }}
        </p>

    </div>

</div>

</AdminLayout>
</template>