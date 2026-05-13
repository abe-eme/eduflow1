<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
    course_id: Number
})

const title = ref('')
const description = ref('')
const due_date = ref('')

const submit = () => {
    router.post(`/teacher/courses/${props.course_id}/assignments`, {
        title: title.value,
        description: description.value,
        due_date: due_date.value
    }, {
        preserveScroll: true,
        onSuccess: () => {
            title.value = ''
            description.value = ''
            due_date.value = ''
        }
    })
}
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-2xl">

    <h1 class="text-2xl font-bold mb-6">
        Create Assignment
    </h1>

    <div class="bg-white p-4 rounded shadow">

        <input
            v-model="title"
            placeholder="Title"
            class="border p-2 w-full mb-3"
        />

        <textarea
            v-model="description"
            placeholder="Description"
            class="border p-2 w-full mb-3"
        />

        <input
            v-model="due_date"
            type="date"
            class="border p-2 w-full mb-3"
        />

        <button
            @click="submit"
            class="bg-green-600 text-white px-4 py-2 rounded"
        >
            Create Assignment
        </button>

    </div>

</div>

</AdminLayout>
</template>