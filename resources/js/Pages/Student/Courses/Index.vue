<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
    courses: Array
})
</script>

<template>
<AdminLayout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">
        Explore Courses
    </h1>

    <!-- GRID CARDS -->
    <div class="grid md:grid-cols-3 gap-6">

        <div
            v-for="course in courses"
            :key="course.id"
            class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden"
        >

            <!-- HEADER -->
            <div class="p-4 border-b">

                <h2 class="text-lg font-bold">
                    {{ course.title }}
                </h2>

                <p class="text-sm text-gray-500">
                    By {{ course.user?.name }}
                </p>

            </div>

            <!-- BODY -->
            <div class="p-4">

                <p class="text-gray-600 text-sm line-clamp-3">
                    {{ course.description }}
                </p>

            </div>

            <!-- FOOTER -->
            <div class="p-4 border-t flex justify-between items-center">

                <span class="text-xs text-gray-400">
                    {{ course.status }}
                </span>

                <Link
                    :href="`/student/courses/${course.id}`"
                    class="bg-blue-600 text-white px-3 py-1 rounded text-sm"
                >
                    View Course
                </Link>

            </div>

        </div>

    </div>

</div>

</AdminLayout>
</template>