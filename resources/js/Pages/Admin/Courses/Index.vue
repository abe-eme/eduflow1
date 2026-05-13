<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { router } from '@inertiajs/vue3'

defineProps({
    courses: Array
})

const approve = (id) => {
    router.post(`/admin/courses/${id}/approve`, {}, {
        preserveScroll: true,
        onSuccess: () => router.reload()
    })
}

const reject = (id) => {
    router.post(`/admin/courses/${id}/reject`, {}, {
        preserveScroll: true,
        onSuccess: () => router.reload()
    })
}

const suspend = (id) => {
    router.post(`/admin/courses/${id}/suspend`, {}, {
        preserveScroll: true,
        onSuccess: () => router.reload()
    })
}
</script>

<template>
<AdminLayout>

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-2xl font-bold">Course Management</h1>
            <p class="text-sm text-gray-500">
                Approve, reject, or suspend courses
            </p>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white shadow rounded overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Teacher</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>

                <tr v-for="course in courses" :key="course.id" class="border-t">

                    <td class="p-3">#{{ course.id }}</td>

                    <td class="p-3 font-medium">
                        {{ course.title }}
                    </td>

                    <td class="p-3">
                        {{ course.user?.name ?? 'Unknown' }}
                    </td>

                    <!-- STATUS -->
                    <td class="p-3">
                        <span
                            class="px-2 py-1 rounded text-xs font-semibold"
                            :class="{
                                'bg-yellow-200 text-yellow-800': course.status === 'pending',
                                'bg-green-200 text-green-800': course.status === 'approved',
                                'bg-red-200 text-red-800': course.status === 'rejected',
                                'bg-gray-200 text-gray-700': course.status === 'suspended'
                            }"
                        >
                            {{ course.status }}
                        </span>
                    </td>

                    <!-- ACTIONS -->
                    <td class="p-3 flex gap-3">

                        <button
                            @click="course.id && approve(course.id)"
                            class="text-green-600 hover:underline">
                            Approve
                        </button>

                        <button
                            @click="reject(course.id)"
                            class="text-red-600 hover:underline">
                            Reject
                        </button>

                        <button
                            @click="suspend(course.id)"
                            class="text-yellow-600 hover:underline">
                            Suspend
                        </button>

                    </td>

                </tr>

                <!-- EMPTY -->
                <tr v-if="courses.length === 0">
                    <td colspan="5" class="p-4 text-center text-gray-400">
                        No courses found
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

</AdminLayout>
</template>