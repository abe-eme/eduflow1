<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  batches: Array
})
</script>

<template>
<AdminLayout>

<div class="p-6">

    <!-- TOP BAR -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">Batch Management</h1>

        <Link
            href="/admin/batches/create"
            class="bg-indigo-600 text-white px-5 py-2 rounded-xl hover:bg-indigo-700 transition"
        >
            + Create Batch
        </Link>

    </div>

    <!-- TABLE -->
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Course</th>
                    <th class="p-3">Teacher</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="batch in batches" :key="batch.id" class="border-t">

                    <td class="p-3">{{ batch.name }}</td>
                    <td class="p-3">{{ batch.course?.title }}</td>
                    <td class="p-3">{{ batch.teacher?.name }}</td>

                    <td class="p-3">
                        <span
                            class="px-3 py-1 rounded-full text-sm"
                            :class="batch.status === 'active'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700'"
                        >
                            {{ batch.status }}
                        </span>
                    </td>

                </tr>
            </tbody>

        </table>

    </div>

</div>

</AdminLayout>
</template>