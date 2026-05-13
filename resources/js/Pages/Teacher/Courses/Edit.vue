<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    course: Object
})

const form = useForm({
    title: props.course.title,
    description: props.course.description
})

const updateCourse = () => {
    form.put(`/teacher/courses/${props.course.id}`)
}
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-2xl">

    <h1 class="text-2xl font-bold mb-4">Edit Course</h1>

    <div class="bg-white p-6 rounded shadow space-y-4">

        <div>
            <label class="text-sm">Title</label>
            <input
                v-model="form.title"
                class="w-full border p-2 rounded"
            />
        </div>

        <div>
            <label class="text-sm">Description</label>
            <textarea
                v-model="form.description"
                class="w-full border p-2 rounded"
            ></textarea>
        </div>

        <button
            @click="updateCourse"
            class="bg-blue-600 text-white px-4 py-2 rounded">

            Update Course

        </button>

    </div>

</div>

</AdminLayout>
</template>