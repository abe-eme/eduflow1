<!-- resources/js/Pages/Teacher/Students/Index.vue -->

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
    course: Object,
    students: {
        type: Array,
        default: () => []
    }
})
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">

        <h1 class="text-3xl font-bold">
            Enrolled Students
        </h1>

    </div>

    <!-- EMPTY -->
    <div
        v-if="students.length === 0"
        class="bg-white p-6 rounded-xl shadow border text-gray-500"
    >
        No students enrolled yet.
    </div>

    <!-- LIST -->
    <div
        v-for="s in students"
        :key="s.id"
        class="bg-white p-5 rounded-xl shadow border mb-4"
    >

        <h2 class="text-xl font-bold text-gray-800">
            {{ s.user?.name }}
        </h2>

        <p class="text-gray-500 mt-1">
            {{ s.user?.email }}
        </p>

        <p class="text-sm text-gray-400 mt-3">
            Joined:
            {{ new Date(s.created_at).toLocaleDateString() }}
        </p>

    </div>

</div>

</AdminLayout>
</template>