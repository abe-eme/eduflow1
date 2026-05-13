<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    course: Object
})

const form = reactive({
    title: '',
    description: ''
})

const submit = () => {
    alert('BUTTON WORKING')

    router.post(`/teacher/courses/${props.course.id}`/quizzes, form, {

        preserveScroll: true,

        onSuccess: () => {
            alert('Quiz created successfully')

            form.title = ''
            form.description = ''
        },

        onError: (errors) => {
            console.log(errors)
        }

    })

}
</script>

<template>
<AdminLayout>

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white rounded-2xl shadow border p-6">

        <h1 class="text-2xl font-bold mb-6">
            Create Quiz
        </h1>

        <!-- TITLE -->
        <div class="mb-4">

            <label class="block text-sm text-gray-600 mb-2">
                Quiz Title
            </label>

            <input
                v-model="form.title"
                type="text"
                class="w-full border rounded-lg p-3"
                placeholder="Enter quiz title"
            />

        </div>

        <!-- DESCRIPTION -->
        <div class="mb-6">

            <label class="block text-sm text-gray-600 mb-2">
                Description
            </label>

            <textarea
                v-model="form.description"
                rows="4"
                class="w-full border rounded-lg p-3"
                placeholder="Quiz description"
            ></textarea>

        </div>

        <!-- BUTTON -->
        <button
            type="button"
            @click="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg"
        >
            Create Quiz
        </button>

    </div>

</div>

</AdminLayout>
</template>