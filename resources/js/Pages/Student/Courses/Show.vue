<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
    course: Object,
    lessons: Array,
    assignments: Array,
    isEnrolled: Boolean
})

const tab = ref('lessons')

const enrollCourse = () => {
    router.post(`/courses/${props.course.id}/enroll`)
}
</script>

<template>
<AdminLayout>

<div class="p-6 max-w-6xl mx-auto">

    <!-- COURSE HEADER -->
    <div class="bg-white rounded-2xl shadow-sm border p-6 mb-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <!-- LEFT -->
            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    {{ course.title }}
                </h1>

                <p class="text-gray-500 mt-3 leading-relaxed">
                    {{ course.description }}
                </p>

                <!-- STATUS -->
                <div class="mt-4 flex items-center gap-2">

                    <span class="text-sm text-gray-500">
                        Course Status:
                    </span>

                    <span
                        :class="course.status === 'approved'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700'"
                        class="px-3 py-1 rounded-full text-sm font-medium"
                    >
                        {{ course.status === 'approved' ? 'Active' : 'Not Active' }}
                    </span>

                </div>

            </div>

            <!-- RIGHT -->
            <div>

                <!-- ENROLL -->
                <button
                    v-if="!isEnrolled"
                    @click="enrollCourse"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium shadow-sm transition"
                >
                    Enroll Course
                </button>

                <!-- ENROLLED -->
                <button
                    v-else
                    disabled
                    class="bg-green-100 text-green-700 px-6 py-3 rounded-xl font-medium cursor-not-allowed"
                >
                    ✓ Enrolled
                </button>

            </div>

        </div>

    </div>

    <!-- TABS -->
    <div class="flex gap-8 border-b mb-6">

        <button
            @click="tab='lessons'"
            class="pb-3 text-sm font-medium transition"
            :class="tab === 'lessons'
                ? 'border-b-2 border-blue-600 text-blue-600'
                : 'text-gray-500 hover:text-gray-700'"
        >
            Lessons
        </button>

        <button
            @click="tab='assignments'"
            class="pb-3 text-sm font-medium transition"
            :class="tab === 'assignments'
                ? 'border-b-2 border-blue-600 text-blue-600'
                : 'text-gray-500 hover:text-gray-700'"
        >
            Assignments
        </button>

    </div>

    <!-- LESSONS -->
    <div v-if="tab === 'lessons'">

        <div
            v-if="lessons.length === 0"
            class="bg-white rounded-xl shadow-sm border p-6 text-gray-500"
        >
            No lessons available yet.
        </div>

        <div
            v-for="lesson in lessons"
            :key="lesson.id"
            class="bg-white rounded-xl shadow-sm border p-5 mb-4 flex justify-between items-center"
        >

            <div>
                <h2 class="font-semibold text-lg text-gray-800">
                    {{ lesson.title }}
                </h2>

                <p class="text-sm text-gray-500 mt-1 capitalize">
                    {{ lesson.type }}
                </p>
            </div>

            <Link
                :href="`/student/courses/${course.id}/lessons/${lesson.id}`"
                class="bg-gray-900 hover:bg-black text-white px-5 py-2 rounded-lg text-sm transition"
            >
                Open Lesson
            </Link>

        </div>

    </div>
<!-- ASSIGNMENTS -->
    <div v-if="tab === 'assignments'">

        <div
            v-if="assignments.length === 0"
            class="bg-white rounded-xl shadow-sm border p-6 text-gray-500"
        >
            No assignments available yet.
        </div>

        <div
            v-for="a in assignments"
            :key="a.id"
            class="bg-white rounded-xl shadow-sm border p-5 mb-4"
        >

            <div class="flex justify-between items-start gap-4">

                <!-- LEFT -->
                <div>

                    <h2 class="font-semibold text-lg text-gray-800">
                        {{ a.title }}
                    </h2>

                    <p class="text-gray-600 text-sm mt-2">
                        {{ a.description }}
                    </p>

                    <p class="text-xs text-gray-400 mt-3">
                        Deadline: {{ a.due_date ?? 'No deadline' }}
                    </p>

                </div>

                <!-- RIGHT -->
                <div class="flex flex-col items-end gap-2">

                    <!-- STATUS -->
                    <span
                        v-if="!a.due_date"
                        class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs"
                    >
                        No Deadline
                    </span>

                    <span
                        v-else-if="new Date(a.due_date) >= new Date()"
                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs"
                    >
                        Active
                    </span>

                    <span
                        v-else
                        class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs"
                    >
                        Expired
                    </span>

                    <!-- OPEN BUTTON -->
                    <Link
                        :href="`/student/assignments/${a.id}`"
                        class="bg-blue-600 text-white px-3 py-1 rounded text-sm"
                    >
                        Open
                    </Link>

                </div>

            </div>

        </div>

    </div>

</div>

</AdminLayout>
</template>