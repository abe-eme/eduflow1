<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    course: Object,
    lessons: Array
})

/*
|--------------------------------------------------------------------------
| TOGGLE PUBLISH
|--------------------------------------------------------------------------
*/
const togglePublish = (lesson) => {

    router.patch(
        `/teacher/lessons/${lesson.id}`/toggle,
        {},
        {
            preserveScroll: true
        }
    )

}

/*
|--------------------------------------------------------------------------
| DELETE LESSON
|--------------------------------------------------------------------------
*/
const deleteLesson = (lesson) => {

    if (confirm('Delete this lesson?')) {

        router.delete(
            `/teacher/courses/${props.course.id}/lessons/${lesson.id}`,
            {
                preserveScroll: true
            }
        )

    }

}
</script>

<template>
<AdminLayout>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50 p-8">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8">

        <div>
            <h1 class="text-4xl font-black text-gray-800">
                {{ course.title }}
            </h1>

            <p class="text-gray-500 mt-2 text-lg">
                Self-Paced Course Lessons
            </p>
        </div>

        <!-- CREATE -->
        <Link
            :href="`/teacher/courses/${course.id}/lessons/create`"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-4 rounded-2xl font-semibold shadow-lg transition"
        >
            + Create Lesson
        </Link>

    </div>

    <!-- EMPTY -->
    <div
        v-if="lessons.length === 0"
        class="bg-white rounded-3xl shadow-xl p-20 text-center"
    >

        <div class="text-6xl mb-5">
            📚
        </div>

        <h2 class="text-3xl font-bold text-gray-800">
            No Lessons Yet
        </h2>

        <p class="text-gray-500 mt-3 text-lg">
            Start building your self-paced course
        </p>

    </div>

    <!-- LESSONS -->
    <div
        v-else
        class="space-y-5"
    >

        <div
            v-for="lesson in lessons"
            :key="lesson.id"
            class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition overflow-hidden"
        >

            <div class="p-7 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <!-- LEFT -->
                <div class="space-y-3">

                    <!-- BADGES -->
                    <div class="flex items-center gap-3 flex-wrap">

                        <span
                            class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-bold"
                        >
                            Lesson {{ lesson.lesson_order }}
                        </span>

                        <span
                            class="px-4 py-2 rounded-full text-sm font-semibold"
                            :class="lesson.is_published
                                ? 'bg-green-100 text-green-700'
                                : 'bg-gray-200 text-gray-700'"
                        >
                            {{ lesson.is_published ? 'Live' : 'Draft' }}
                        </span>

                    </div>

                    <!-- TITLE -->
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ lesson.title }}
                    </h2>

                    <!-- INFO -->
                    <div class="flex flex-wrap gap-4 text-gray-500 text-sm">

                        <span class="capitalize">
                            {{ lesson.type }}
                        </span>

                        <span>
                            •
                        </span>

                        <span>
                            {{ lesson.duration ?? 0 }} min
                        </span>

                    </div>

                </div>
<!-- ACTIONS -->
                <div class="flex flex-wrap gap-5 text-sm font-semibold">

                    <!-- VIEW -->
                    <Link
                        :href="`/teacher/courses/${course.id}/lessons/${lesson.id}`"
                        class="text-gray-600 hover:text-black hover:underline"
                    >
                        View
                    </Link>

                    <!-- EDIT -->
                    <Link
                        :href="`/teacher/courses/${course.id}/lessons/${lesson.id}`/edit"
                        class="text-indigo-600 hover:underline"
                    >
                        Edit
                    </Link>

                    <!-- DELETE -->
                    <button
                        @click="deleteLesson(lesson)"
                        class="text-red-600 hover:underline"
                    >
                        Delete
                    </button>

                    <!-- TOGGLE -->
                    <button
                        @click="togglePublish(lesson)"
                        class="text-green-600 hover:underline"
                    >
                        {{ lesson.is_published
                            ? 'Unpublish'
                            : 'Publish'
                        }}
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

</AdminLayout>
</template>