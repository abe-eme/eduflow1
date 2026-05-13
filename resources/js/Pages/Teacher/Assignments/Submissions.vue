<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
    assignment: Object,
    submissions: Array
})
</script>

<template>
<AdminLayout>

<div class="max-w-5xl mx-auto p-6 space-y-6">

    <!-- HEADER -->
    <div class="bg-white border rounded-xl p-5">

        <h1 class="text-2xl font-bold text-gray-800">
            {{ assignment.title }} - Submissions
        </h1>

    </div>

    <!-- EMPTY -->
    <div v-if="submissions.length === 0" class="text-gray-500">
        No submissions yet.
    </div>

    <!-- LIST -->
    <div
        v-for="s in submissions"
        :key="s.id"
        class="bg-white border rounded-xl p-5 space-y-3"
    >

        <!-- STUDENT INFO -->
        <div class="flex justify-between">

            <div>
                <h2 class="font-semibold">
                    {{ s.user?.name }}
                </h2>

                <p class="text-sm text-gray-500">
                    {{ s.user?.email }}
                </p>
            </div>

            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                Submitted
            </span>

        </div>

        <!-- ANSWER -->
        <p class="text-gray-700 whitespace-pre-line">
            {{ s.answer || 'No text answer provided' }}
        </p>

        <!-- FILE DOWNLOAD (IMPORTANT FIX) -->
        <div v-if="s.file" class="mt-2">

            <a
                :href="`/storage/${s.file}`"
                target="_blank"
                class="text-blue-600 underline font-medium"
            >
                📎 Download Submitted File
            </a>

        </div>

        <!-- TIME -->
        <div class="text-sm text-gray-400">
            {{ new Date(s.created_at).toLocaleString() }}
        </div>

    </div>

</div>

</AdminLayout>
</template>