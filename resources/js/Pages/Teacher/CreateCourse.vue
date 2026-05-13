<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    title: '',
    description: ''
})

const submit = () => {
    form.post('/teacher/courses')
}
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-xl">

    <h1 class="text-2xl font-bold mb-4">Create Course</h1>

    <div class="bg-white p-6 rounded shadow space-y-4">

        <input
            v-model="form.title"
            placeholder="Course title"
            class="w-full p-3 border rounded"
        />

        <textarea
            v-model="form.description"
            placeholder="Course description"
            class="w-full p-3 border rounded"
        ></textarea>

        <button
            @click="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded">
            Create
        </button>

    </div>

</div>

</AdminLayout>
</template>