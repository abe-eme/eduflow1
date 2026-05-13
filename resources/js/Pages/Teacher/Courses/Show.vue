<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    course: Object
})
</script>
<template>
<AdminLayout>

<div class="min-h-screen bg-gradient-to-br from-slate-100 via-indigo-50 to-blue-100 p-8">

    <!-- COURSE HEADER CARD -->
    <div class="max-w-6xl mx-auto">

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-10 mb-10 relative overflow-hidden">

            <!-- decorative background glow -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-200 rounded-full blur-3xl opacity-40"></div>

            <h1 class="text-4xl font-extrabold text-gray-800">
                {{ course.title }}
            </h1>

            <p class="text-gray-600 mt-4 text-lg leading-relaxed max-w-3xl">
                {{ course.description }}
            </p>

            <div class="mt-6 flex gap-3">
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                    Teacher Dashboard
                </span>
                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                    Active Course
                </span>
            </div>

        </div>

        <!-- MODULE GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- LESSONS -->
            <Link
                :href="`/teacher/courses/${course.id}/lessons`"
                class="group bg-white rounded-3xl shadow-md border border-gray-100 p-8 hover:shadow-2xl hover:-translate-y-1 transition duration-300"
            >
                <div class="text-5xl mb-4 group-hover:scale-110 transition">📚</div>
                <h2 class="text-xl font-bold text-gray-800">Lessons</h2>
                <p class="text-gray-500 mt-2 text-sm">
                    Create and manage course content
                </p>
            </Link>

            <!-- ASSIGNMENTS -->
            <Link
                :href="`/teacher/courses/${course.id}/assignments`"
                class="group bg-white rounded-3xl shadow-md border border-gray-100 p-8 hover:shadow-2xl hover:-translate-y-1 transition duration-300"
            >
                <div class="text-5xl mb-4 group-hover:scale-110 transition">📝</div>
                <h2 class="text-xl font-bold text-gray-800">Assignments</h2>
                <p class="text-gray-500 mt-2 text-sm">
                    Evaluate student learning
                </p>
            </Link>

            <!-- STUDENTS -->
            <Link
                :href="`/teacher/courses/${course.id}/students`"
                class="group bg-white rounded-3xl shadow-md border border-gray-100 p-8 hover:shadow-2xl hover:-translate-y-1 transition duration-300"
            >
                <div class="text-5xl mb-4 group-hover:scale-110 transition">👨‍🎓</div>
                <h2 class="text-xl font-bold text-gray-800">Students</h2>
                <p class="text-gray-500 mt-2 text-sm">
                    Track enrolled learners
                </p>
            </Link>

            <!-- QUIZZES -->
            <Link
                :href="`/teacher/courses/${course.id}/quizzes/create`"
                class="group bg-white rounded-3xl shadow-md border border-gray-100 p-8 hover:shadow-2xl hover:-translate-y-1 transition duration-300"
            >
                <div class="text-5xl mb-4 group-hover:scale-110 transition">🧠</div>
                <h2 class="text-xl font-bold text-gray-800">Quizzes</h2>
                <p class="text-gray-500 mt-2 text-sm">
                    Test student knowledge
                </p>
            </Link>

        </div>

    </div>

</div>

</AdminLayout>
</template>