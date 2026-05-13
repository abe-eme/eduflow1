<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
    course: Object,
    lesson: Object
})

const form = useForm({
    title: props.lesson.title,
    content: props.lesson.content,
    type: props.lesson.type,
    order: props.lesson.order
})

const update = () => {
    form.put(`/teacher/courses/${props.course.id}/lessons/${props.lesson.id}`)
}
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6 flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">Edit Lesson</h1>
            <p class="text-sm text-gray-500">Update lesson content</p>
        </div>

        <!-- BACK BUTTON -->
        <Link
            :href="`/teacher/courses/${course.id}/lessons`"
            class="text-blue-600 hover:underline"
        >
            ← Back to Lessons
        </Link>

    </div>

    <!-- FORM -->
    <div class="bg-white p-6 rounded-xl shadow space-y-5">

        <div>
            <label class="text-sm text-gray-600">Lesson Title</label>
            <input v-model="form.title" class="w-full mt-1 p-3 border rounded-lg" />
        </div>

        <div>
            <label class="text-sm text-gray-600">Type</label>
            <select v-model="form.type" class="w-full mt-1 p-3 border rounded-lg">
                <option value="text">Text</option>
                <option value="video">Video</option>
                <option value="image">Image</option>
            </select>
        </div>

        <div>
            <label class="text-sm text-gray-600">Content</label>

            <textarea
                v-if="form.type === 'text'"
                v-model="form.content"
                class="w-full mt-1 p-3 border rounded-lg"
                rows="5"
            ></textarea>

            <input
                v-else
                v-model="form.content"
                class="w-full mt-1 p-3 border rounded-lg"
                placeholder="Video or Image URL"
            />
        </div>

        <div>
            <label class="text-sm text-gray-600">Order</label>
            <input
                type="number"
                v-model="form.order"
                class="w-full mt-1 p-3 border rounded-lg"
            />
        </div>

        <button
            @click="update"
            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"
        >
            Update Lesson
        </button>

    </div>

</div>

</AdminLayout>
</template>