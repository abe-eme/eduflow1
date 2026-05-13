<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { router } from '@inertiajs/vue3'
import { reactive } from 'vue'

const props = defineProps({
    assignment: Object,
    isSubmitted: Boolean
})

const form = reactive({
    answer: '',
    file: null
})

const submitAssignment = () => {

    if (props.isSubmitted) {
        alert('You already submitted this assignment')
        return
    }

    const data = new FormData()

    data.append('answer', form.answer)

    if (form.file) {
        data.append('file', form.file)
    }

    // ✅ FIXED ROUTE
    router.post(
        `/student/assignments/${props.assignment.id}/submit`,
        data,
        {
            forceFormData: true,
            preserveScroll: true,

            onSuccess: () => {
                form.answer = ''
                form.file = null

                // ✅ FIXED ROUTE
                router.visit(`/student/assignments/${props.assignment.id}`)

                alert('Assignment submitted successfully')
            },

            onError: (errors) => {
                console.log(errors)
            }
        }
    )
}
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-4xl mx-auto">

    <!-- ASSIGNMENT INFO -->
    <div class="bg-white p-6 rounded-xl shadow border">

        <h1 class="text-2xl font-bold">
            {{ assignment.title }}
        </h1>

        <p class="text-gray-600 mt-3">
            {{ assignment.description }}
        </p>

        <div class="mt-4 text-sm text-gray-500">
            Deadline: {{ assignment.due_date ?? 'No deadline' }}
        </div>

        <!-- STATUS -->
        <div class="mt-3">
            <span v-if="isSubmitted" class="bg-green-100 text-green-700 px-3 py-1 rounded">
                ✓ Already Submitted
            </span>

            <span v-else class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                Not Submitted
            </span>
        </div>

    </div>

    <!-- SUBMIT SECTION -->
    <div class="bg-white p-6 rounded-xl shadow border mt-6">

        <h2 class="text-lg font-semibold mb-4">
            Submit Assignment
        </h2>

        <!-- IF ALREADY SUBMITTED -->
        <div v-if="isSubmitted" class="text-green-600 font-medium">
            You have already submitted this assignment.
        </div>

        <!-- SUBMIT FORM -->
        <div v-else>

            <textarea
                v-model="form.answer"
                class="w-full border rounded p-3"
                placeholder="Write your answer..."
            ></textarea>

            <input
                type="file"
                @change="e => form.file = e.target.files[0]"
                class="block mt-3"
            />

            <button
                @click="submitAssignment"
                class="mt-4 bg-green-600 text-white px-5 py-2 rounded"
            >
                Submit Assignment
            </button>

        </div>

    </div>

</div>

</AdminLayout>
</template>