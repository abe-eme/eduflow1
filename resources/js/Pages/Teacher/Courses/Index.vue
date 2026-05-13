<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({
    courses: Array
})

const deleteCourse = (id) => {
    if (confirm('Are you sure you want to delete this course?')) {
        router.delete(`/teacher/courses/${id}`, {
            preserveScroll: true,
            onSuccess: () => router.reload()
        })
    }
}
</script>

<template>
<AdminLayout>

<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">My Courses</h1>
            <p class="text-sm text-gray-500 mt-1">
                Manage and organize your learning content professionally
            </p>
        </div>

        <Link
            href="/teacher/courses/create"
            class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-5 py-2 rounded-xl shadow-md hover:scale-105 transition"
        >
            + Create Course
        </Link>

    </div>

    <!-- TABLE CONTAINER -->
    <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-2xl overflow-hidden border border-gray-100">

        <table class="w-full text-left">

            <thead class="bg-gray-100/70 text-gray-700">
                <tr>
                    <th class="p-4">Title</th>
                    <th class="p-4">Description</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>

            <tbody>

                <tr
                    v-for="course in courses"
                    :key="course.id"
                    class="border-t hover:bg-blue-50 transition"
                >

                    <!-- TITLE -->
                    <td class="p-4 font-semibold text-blue-700">
                        <Link :href="`/teacher/courses/${course.id}`">
                            {{ course.title }}
                        </Link>
                    </td>

                    <!-- DESCRIPTION -->
                    <td class="p-4 text-gray-600">
                        {{ course.description }}
                    </td>

                    <!-- STATUS -->
                    <td class="p-4">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-bold"
                            :class="{
                                'bg-yellow-100 text-yellow-700': course.status === 'pending',
                                'bg-green-100 text-green-700': course.status === 'approved',
                                'bg-red-100 text-red-700': course.status === 'rejected'
                            }"
                        >
                            {{ course.status }}
                        </span>
                    </td>

                    <!-- ACTIONS -->
                    <td class="p-4 flex gap-4">

                        <Link
                            :href="`/teacher/courses/${course.id}/edit`"
                            class="text-blue-600 hover:text-blue-800 font-medium"
                        >
                            Edit
                        </Link>

                        <button
                            @click="deleteCourse(course.id)"
                            class="text-red-600 hover:text-red-800 font-medium"
                        >
                            Delete
                        </button>

                        <Link
                            :href="`/teacher/courses/${course.id}`"
                            class="text-green-600 hover:text-green-800 font-medium"
                        >
                            Open
                        </Link>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

</AdminLayout>
</template>