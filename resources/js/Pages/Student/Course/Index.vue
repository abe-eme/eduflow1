<script setup>
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    courses: Array
})

/*
|--------------------------------------------------------------------------
| ENROLL
|--------------------------------------------------------------------------
*/
const enroll = (course) => {

    router.post(route('courses.enroll', course.id), {}, {
        preserveScroll: true,
        onSuccess: () => {
            router.reload({ only: ['courses'] })
        }
    })
}

/*
|--------------------------------------------------------------------------
| UNENROLL
|--------------------------------------------------------------------------
*/
const unenroll = (course) => {

    router.delete(route('courses.unenroll', course.id), {
        preserveScroll: true,
        onSuccess: () => {
            router.reload({ only: ['courses'] })
        }
    })
}
</script>

<template>

<div class="min-h-screen bg-gray-50 p-8">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Explore Courses</h1>
        <p class="text-gray-500">Start learning at your own pace</p>
    </div>

    <!-- EMPTY -->
    <div v-if="!courses || courses.length === 0" class="text-center p-10">
        No courses available
    </div>

    <!-- COURSES -->
    <div v-else class="grid md:grid-cols-3 gap-6">

        <div
            v-for="course in courses"
            :key="course.id"
            class="bg-white p-5 rounded-xl shadow"
        >

            <h2 class="text-xl font-bold">
                {{ course.title }}
            </h2>

            <p class="text-gray-500 text-sm mt-2">
                {{ course.description }}
            </p>

            <div class="mt-5 space-y-2">

                <!-- START -->
                <Link
                    :href="route('student.courses.show', course.id)"
                    class="block bg-blue-600 text-white text-center py-2 rounded-lg"
                >
                    Start Learning
                </Link>

                <!-- NOT ENROLLED -->
                <button
                    v-if="!course.is_enrolled"
                    @click="enroll(course)"
                    class="w-full bg-green-600 text-white py-2 rounded-lg"
                >
                    Enroll Now
                </button>

                <!-- ENROLLED -->
                <div v-else class="space-y-2">

                    <div class="text-center text-green-700 font-bold bg-green-100 py-2 rounded-lg">
                        ✓ Enrolled
                    </div>

                    <button
                        @click="unenroll(course)"
                        class="w-full bg-red-600 text-white py-2 rounded-lg"
                    >
                        Unenroll
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

</template>