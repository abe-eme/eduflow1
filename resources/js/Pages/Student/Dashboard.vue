[5/8/2026 1:16 AM] Fĕří: <script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({
    enrolledCourses: Number
})
</script>

<template>
<AdminLayout>

<div class="min-h-screen relative bg-black">

    <!-- BACKGROUND -->
    <div class="absolute inset-0">
        <img
            src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1600&auto=format&fit=crop"
            class="w-full h-full object-cover opacity-40"
        />
        <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-black/70 to-black"></div>
    </div>

    <div class="relative z-10 p-6 max-w-6xl mx-auto">

        <!-- IDENTITY CARD (NO IMAGE BUT PERSONAL FEEL) -->
        <div class="mb-10 bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 relative overflow-hidden">

            <div class="absolute -top-10 -right-10 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl"></div>

            <h1 class="text-4xl font-extrabold text-white">
                Welcome Back 🎓
            </h1>

            <p class="text-gray-300 mt-2 text-lg">
                Your learning journey continues — stay consistent, stay growing.
            </p>

            <!-- subtle “student identity feel” -->
            <div class="mt-6 flex items-center gap-3">

                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>

                <p class="text-sm text-gray-300">
                    Active Student • Learning in Progress
                </p>

            </div>

        </div>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 text-white">
                <p class="text-sm text-gray-300">Enrolled Courses</p>
                <h2 class="text-4xl font-bold mt-2">{{ enrolledCourses }}</h2>
            </div>

            <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 text-white">
                <p class="text-sm text-gray-300">Completed Lessons</p>
                <h2 class="text-4xl font-bold mt-2 text-cyan-300">0</h2>
            </div>

            <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 text-white">
                <p class="text-sm text-gray-300">Progress</p>
                <h2 class="text-4xl font-bold mt-2 text-green-300">0%</h2>
            </div>

        </div>

        <!-- ACTIONS (ONE ROW - FIXED UX) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- CONTINUE LEARNING -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl group">

                <img
                    src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1200&auto=format&fit=crop"
                    class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                />

                <div class="absolute inset-0 bg-black/60"></div>

                <div class="absolute inset-0 p-8 flex flex-col justify-end text-white">

                    <h3 class="text-2xl font-bold">
                        Continue Learning
                    </h3>

                    <p class="text-gray-200 text-sm mt-2">
                        Resume your last course and keep progressing
                    </p>

                    <button
                        @click="$inertia.visit('/student/my-courses')"
                        class="mt-4 bg-blue-600 px-6 py-3 rounded-2xl w-fit hover:bg-blue-700 transition"
                    >
                        My Courses →
                    </button>

                </div>

            </div>

            <!-- EXPLORE COURSES -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl group">

                <img
                    src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1200&auto=format&fit=crop"
                    class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                />
[5/8/2026 1:16 AM] Fĕří: <div class="absolute inset-0 bg-black/60"></div>

                <div class="absolute inset-0 p-8 flex flex-col justify-end text-white">

                    <h3 class="text-2xl font-bold">
                        Explore Courses
                    </h3>

                    <p class="text-gray-200 text-sm mt-2">
                        Find new skills and expand your knowledge
                    </p>

                    <button
                        @click="$inertia.visit('/student/courses')"
                        class="mt-4 bg-white text-black px-6 py-3 rounded-2xl w-fit hover:bg-gray-200 transition"
                    >
                        Browse →
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

</AdminLayout>
</template>