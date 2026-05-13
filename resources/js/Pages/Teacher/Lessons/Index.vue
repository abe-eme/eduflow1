<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    course: Object,
    lessons: Array
})

const deleteLesson = (id) => {
    if (confirm('Delete this lesson?')) {
        router.delete(`/teacher/courses/${props.course.id}/lessons/${id}`)
    }
}
</script>

<template>
<AdminLayout>

<div class="max-w-6xl mx-auto p-6 space-y-6">

    <!-- COURSE HEADER -->
    <div class="bg-white border rounded-2xl p-6 shadow-sm">

        <h1 class="text-3xl font-bold text-gray-800">
            {{ course.title }}
        </h1>

        <p class="text-gray-500 mt-1">
            Manage lessons efficiently
        </p>

    </div>

    <!-- TOP BAR -->
    <div class="flex justify-between items-center">

        <h2 class="text-xl font-semibold text-gray-800">
            Lessons
        </h2>

        <Link
            :href="`/teacher/courses/${course.id}/lessons/create`"
            class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition"
        >
            + Create Lesson
        </Link>

    </div>

    <!-- TABLE -->
    <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">

        <div class="grid grid-cols-12 bg-gray-50 text-gray-600 text-sm font-semibold uppercase px-6 py-4">

            <div class="col-span-1">#</div>
            <div class="col-span-3">Title</div>
            <div class="col-span-2">Type</div>
            <div class="col-span-3">Created</div>
            <div class="col-span-3 text-right">Actions</div>

        </div>

        <div>

            <div
                v-for="(lesson, index) in lessons"
                :key="lesson.id"
                class="grid grid-cols-12 items-center px-6 py-4 border-t hover:bg-gray-50 transition"
            >

                <div class="col-span-1 font-bold text-gray-700">
                    {{ index + 1 }}
                </div>

                <div class="col-span-3 font-medium text-gray-800">
                    {{ lesson.title }}
                </div>

                <div class="col-span-2">
                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                        {{ lesson.type ?? 'text' }}
                    </span>
                </div>

                <div class="col-span-3 text-gray-500 text-sm">
                    {{ new Date(lesson.created_at).toLocaleDateString() }}
                </div>

                <div class="col-span-3 flex justify-end gap-3">

                    <Link
                        :href="`/teacher/courses/${course.id}/lessons/${lesson.id}`"
                        class="text-green-600 hover:underline"
                    >
                        Open
                    </Link>

                    <Link
                        :href="`/teacher/courses/${course.id}/lessons/${lesson.id}`/edit"
                        class="text-blue-600 hover:underline"
                    >
                        Edit
                    </Link>

                    <button
                        @click="deleteLesson(lesson.id)"
                        class="text-red-600 hover:underline"
                    >
                        Delete
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

</AdminLayout>
</template>