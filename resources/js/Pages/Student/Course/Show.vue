<script setup>
import { router, Link } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
    course: Object,
    lessons: Array,
    isEnrolled: Boolean,
    lastLesson: Object
})

/*
|--------------------------------------------------------------------------
| ENROLL COURSE
|--------------------------------------------------------------------------
*/
const enroll = (id) => {
    router.post(`/courses/${id}/enroll`, {}, {
        preserveScroll: true,
        onSuccess: () => {
            router.reload() // refresh enrollment state
        }
    })
}
</script>

<template>
<AdminLayout>

<div class="min-h-screen bg-gray-100">

    <!-- HEADER -->
    <div class="bg-white border-b px-6 py-4 flex justify-between items-center">

        <div>
            <h1 class="text-xl font-bold text-gray-800">
                {{ course.title }}
            </h1>

            <p class="text-sm text-gray-500">
                Self-paced learning course
            </p>
        </div>

        <!-- RIGHT ACTION -->
        <div>

            <!-- NOT ENROLLED -->
            <button
                v-if="!isEnrolled"
                @click="enroll(course.id)"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl"
            >
                Enroll Now
            </button>

            <!-- ENROLLED -->
            <Link
                v-else
                :href="`/student/courses/${course.id}/lessons/${lastLesson?.id || lessons[0].id}`"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl inline-block"
            >
                Start Learning
            </Link>

        </div>

    </div>

    <!-- COURSE CONTENT -->
    <div class="p-6 max-w-5xl mx-auto">

        <!-- LESSON LIST -->
        <div class="bg-white rounded-2xl shadow">

            <div class="p-4 border-b font-semibold text-gray-700">
                Course Lessons
            </div>

            <div v-if="lessons && lessons.length">

                <div
                    v-for="lesson in lessons"
                    :key="lesson.id"
                    class="p-4 border-b flex justify-between items-center"
                >

                    <div>
                        <p class="font-medium text-gray-800">
                            {{ lesson.title }}
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ lesson.type || 'text' }} • {{ lesson.duration }} min
                        </p>
                    </div>

                    <!-- LOCK UNTIL ENROLLED -->
                    <div v-if="!isEnrolled" class="text-sm text-gray-400">
                        🔒 Locked
                    </div>

                    <!-- OPEN -->
                    <Link
                        v-else
                        :href="`/student/courses/${course.id}/lessons/${lesson.id}`"
                        class="text-indigo-600 text-sm hover:underline"
                    >
                        Open
                    </Link>

                </div>

            </div>

            <div v-else class="p-6 text-gray-500">
                No lessons available yet
            </div>

        </div>

    </div>

</div>

</AdminLayout>
</template>