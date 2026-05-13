<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
    course: Object
})

const form = useForm({
    title: '',
    type: 'text',
    content: '',
    order: 1
})

const submit = () => {
    form.post(`/teacher/courses/${props.course.id}/lessons`, {
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6 flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">
                Add Lesson - {{ course.title }}
            </h1>
            <p class="text-sm text-gray-500">
                Create lesson content for students
            </p>
        </div>

        <Link
            :href="`/teacher/courses/${course.id}/lessons`"
            class="text-blue-600 hover:underline"
        >
            ← Back
        </Link>

    </div>

    <!-- FORM -->
    <div class="bg-white p-6 rounded-xl shadow space-y-5">

        <!-- TITLE -->
        <div>
            <label class="text-sm text-gray-600">Lesson Title</label>
            <input
                v-model="form.title"
                type="text"
                class="w-full mt-1 p-3 border rounded-lg"
                placeholder="Enter lesson title"
            />
        </div>

        <!-- TYPE -->
        <div>
            <label class="text-sm text-gray-600">Lesson Type</label>
            <select
                v-model="form.type"
                class="w-full mt-1 p-3 border rounded-lg"
            >
                <option value="text">Text Lesson</option>
                <option value="video">Video Lesson (YouTube)</option>
                <option value="image">Image Lesson</option>
            </select>
        </div>

        <!-- CONTENT -->
        <div>
            <label class="text-sm text-gray-600">Content</label>

            <!-- TEXT -->
            <textarea
                v-if="form.type === 'text'"
                v-model="form.content"
                class="w-full mt-1 p-3 border rounded-lg"
                rows="5"
                placeholder="Write lesson content..."
            ></textarea>

            <!-- VIDEO -->
            <input
                v-if="form.type === 'video'"
                v-model="form.content"
                type="text"
                class="w-full mt-1 p-3 border rounded-lg"
                placeholder="Paste YouTube link (https://youtube.com/watch?v=...)"
            />

            <!-- IMAGE -->
            <input
                v-if="form.type === 'image'"
                v-model="form.content"
                type="text"
                class="w-full mt-1 p-3 border rounded-lg"
                placeholder="Paste image URL"
            />
        </div>

        <!-- ORDER -->
        <div>
            <label class="text-sm text-gray-600">Lesson Order</label>
            <input
                v-model="form.order"
                type="number"
                class="w-full mt-1 p-3 border rounded-lg"
            />
        </div>

        <!-- BUTTON -->
        <button
            @click="submit"
            :disabled="form.processing"
            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"
        >
            Create Lesson
        </button>

    </div>

</div>

</AdminLayout>
</template>