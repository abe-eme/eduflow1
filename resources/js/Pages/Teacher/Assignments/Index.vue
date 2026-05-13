<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    assignments: Array,
    course_id: Number
})
</script>

<template>
<AdminLayout>

<div class="max-w-6xl mx-auto p-6 space-y-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Assignments
            </h1>
            <p class="text-sm text-gray-500">
                Manage course assignments
            </p>
        </div>

        <!-- FIXED ROUTE -->
        <Link
            :href="`/teacher/courses/${course_id}/assignments/create`"
            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700"
        >
            + Create Assignment
        </Link>

    </div>

    <!-- LIST -->
    <div class="space-y-4">

qw          <div
            v-for="a in assignments"
            :key="a.id"
            class="bg-white border rounded-xl p-5 shadow-sm flex justify-between items-center"
        >

            <!-- LEFT -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    {{ a.title }}
                </h2>

                <p class="text-sm text-gray-500">
                    Due: {{ a.due_date ?? 'No deadline' }}
                </p>
            </div>

            <!-- RIGHT -->
            <div class="flex gap-3 items-center">

                <!-- FIXED ROUTE -->
                <Link
                    :href="`/teacher/assignments/${a.id}/submissions`"
                    class="text-green-600 hover:underline text-sm"
                >
                    Submissions
                </Link>

            </div>

        </div>

    </div>

</div>

</AdminLayout>
</template>