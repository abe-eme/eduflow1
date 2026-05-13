<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { router } from '@inertiajs/vue3'
import { reactive } from 'vue'

const props = defineProps({
    assignment: Object
})

const form = reactive({
    title: props.assignment.title,
    description: props.assignment.description,
    due_date: props.assignment.due_date
})

const updateAssignment = () => {
    router.put(`/teacher/assignments/${props.assignment.id}S`, form, {
        onSuccess: () => {
            alert('Assignment updated successfully')
        }
    })
}
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold mb-4">Edit Assignment</h1>

    <input v-model="form.title" class="w-full border p-2 mb-3" placeholder="Title" />

    <textarea v-model="form.description" class="w-full border p-2 mb-3" placeholder="Description"></textarea>

    <input v-model="form.due_date" type="date" class="w-full border p-2 mb-3" />

    <button @click="updateAssignment" class="bg-blue-600 text-white px-4 py-2 rounded">
        Update Assignment
    </button>

</div>

</AdminLayout>
</template>