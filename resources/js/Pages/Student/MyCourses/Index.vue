<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({
    enrollments: Array
})

/*
|--------------------------------------------------------------------------
| UNENROLL FUNCTION
|--------------------------------------------------------------------------
*/
const unenroll = (courseId) => {
    if (confirm('Are you sure you want to unenroll?')) {
        router.delete(`/courses/${courseId}/unenroll`, {
            preserveScroll: true
        })
    }
}
</script>

<template>

<AdminLayout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">
        My Courses
    </h1>

    <!-- EMPTY STATE -->
    <div v-if="enrollments.length === 0" class="text-gray-500">
        You are not enrolled in any course yet.
    </div>

    <!-- COURSES LIST -->
    <div class="grid gap-4">

        <div
            v-for="enroll in enrollments"
            :key="enroll.id"
            class="bg-white p-4 rounded shadow flex justify-between items-center"
        >

            <!-- LEFT -->
            <div>

                <h2 class="text-xl font-semibold">
                    {{ enroll.course.title }}
                </h2>

                <p class="text-gray-500">
                    {{ enroll.course.description }}
                </p>

                <Link
                    :href="`/student/courses/${enroll.course.id}`"
                    class="text-blue-600 mt-2 inline-block"
                >
                    Continue Learning
                </Link>

            </div>

            <!-- RIGHT (UNENROLL BUTTON) -->
            <div>

                <button
                    @click="unenroll(enroll.course.id)"
                    class="text-red-600 text-sm hover:underline"
                >
                    Unenroll
                </button>

            </div>

        </div>

    </div>

</div>

</AdminLayout>

</template>