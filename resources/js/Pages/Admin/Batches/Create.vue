<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

defineProps({
  courses: Array,
  teachers: Array
})

const form = useForm({
  name: '',
  course_id: '',
  teacher_id: '',
  start_date: '',
  end_date: ''
})

const submit = () => {
  form.post('/admin/batches')
}
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Create Batch</h1>

    <div class="space-y-4 bg-white p-6 rounded-xl shadow">

        <input v-model="form.name" placeholder="Batch Name" class="w-full border p-3 rounded" />

        <!-- COURSE -->
        <select v-model="form.course_id" class="w-full border p-3 rounded">
            <option value="">Select Course</option>
            <option v-for="c in courses" :key="c.id" :value="c.id">
                {{ c.title }}
            </option>
        </select>

        <!-- TEACHER -->
        <select v-model="form.teacher_id" class="w-full border p-3 rounded">
            <option value="">Select Teacher</option>
            <option v-for="t in teachers" :key="t.id" :value="t.id">
                {{ t.name }}
            </option>
        </select>

        <input type="date" v-model="form.start_date" class="w-full border p-3 rounded" />

        <input type="date" v-model="form.end_date" class="w-full border p-3 rounded" />

        <button
            @click="submit"
            class="bg-indigo-600 text-white w-full py-3 rounded"
        >
            Create Batch
        </button>

    </div>

</div>

</AdminLayout>
</template>