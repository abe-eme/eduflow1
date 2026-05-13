<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

import {
    GraduationCap,
    Plus,
    BookOpen,
    ArrowRight,
    Bell,
    Layers3,
    Sparkles
} from 'lucide-vue-next'

defineProps({
    totalCourses: Number,
    approvedCourses: Number,
    pendingCourses: Number,
    rejectedCourses: Number,
    recentCourses: Array
})
</script>

<template>
<AdminLayout>

<div class="min-h-screen bg-[#f5f7fb]">

    <!-- ================= HERO ================= -->
    <section class="relative overflow-hidden">

        <!-- BACKGROUND -->
        <div class="absolute inset-0">

            <img
                src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1600&auto=format&fit=crop"
                class="w-full h-[360px] object-cover"
            />

            <div class="absolute inset-0 bg-gradient-to-r from-[#081f5c]/95 via-[#0f3b94]/85 to-[#2563eb]/75"></div>

        </div>

        <!-- EFFECT -->
        <div class="absolute top-10 right-20 w-72 h-72 bg-cyan-300/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl"></div>

        <!-- CONTENT -->
        <div class="relative z-10 px-6 lg:px-12 py-10">

            <!-- TOP -->
            <div class="flex justify-between items-center">

                <!-- LOGO -->
                <div class="flex items-center gap-4">

                    <div class="bg-white/10 backdrop-blur-xl p-3 rounded-2xl border border-white/20">
                        <GraduationCap class="text-white w-7 h-7"/>
                    </div>

                    <div>

                        <h1 class="text-3xl font-black text-white">
                            EduFlow
                        </h1>

                        <p class="text-blue-100 text-sm">
                            Teacher Dashboard
                        </p>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-4">

                    <button
                        class="bg-white/10 border border-white/20 backdrop-blur-xl p-3 rounded-2xl text-white hover:bg-white/20 transition"
                    >
                        <Bell class="w-5 h-5"/>
                    </button>

                    <img
                        src="https://i.pravatar.cc/100"
                        class="w-12 h-12 rounded-2xl border-2 border-white shadow-xl"
                    />

                </div>

            </div>

            <!-- HERO GRID -->
            <div class="grid lg:grid-cols-2 gap-10 items-center mt-12">

                <!-- LEFT -->
                <div>

                    <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 px-4 py-2 rounded-full text-blue-100 text-sm mb-5 backdrop-blur-xl">
                        <Sparkles class="w-4 h-4"/>
                        Professional Learning Platform
                    </div>

                    <h2 class="text-5xl lg:text-6xl font-black text-white leading-tight">
                        Build Amazing
                        <span class="text-cyan-300">
                            Learning
                        </span>
                        Experiences
                    </h2>

                    <p class="mt-6 text-blue-100 text-lg leading-relaxed max-w-2xl">
                        Manage courses, lessons, assignments and student learning
                        in one beautiful and modern educational platform.
                    </p>

                    <!-- BUTTONS -->
                    <div class="flex flex-wrap gap-4 mt-8">

                        <button
                            @click="$inertia.visit('/teacher/courses/create')" Fĕří: class="bg-white text-blue-700 px-7 py-4 rounded-2xl font-bold shadow-xl hover:scale-105 transition flex items-center gap-2"
                        >
                            <Plus class="w-5 h-5"/>
                            Create Course
                        </button>

                        <button
                            @click="$inertia.visit('/teacher/courses')"
                            class="bg-white/10 border border-white/20 backdrop-blur-xl text-white px-7 py-4 rounded-2xl font-semibold hover:bg-white/20 transition flex items-center gap-2"
                        >
                            Manage Courses
                            <ArrowRight class="w-5 h-5"/>
                        </button>

                    </div>

                </div>

                <!-- RIGHT -->
                <div>

                    <!-- MAIN ANALYTICS CARD -->
                    <div
                        class="bg-white/10 backdrop-blur-2xl border border-white/20 rounded-[35px] p-7 shadow-2xl"
                    >

                        <div class="flex justify-between items-start mb-8">

                            <div>

                                <p class="text-blue-100 text-sm">
                                    Total Courses
                                </p>

                                <h2 class="text-6xl font-black text-white mt-3">
                                    {{ totalCourses }}
                                </h2>

                            </div>

                            <div class="bg-white/10 p-4 rounded-3xl border border-white/20">
                                <Layers3 class="w-10 h-10 text-cyan-300"/>
                            </div>

                        </div>

                        <!-- MINI CARDS -->
                        <div class="grid grid-cols-3 gap-4">

                            <!-- APPROVED -->
                            <div class="bg-white/10 border border-white/10 rounded-2xl p-4 text-center">

                                <p class="text-xs text-blue-100">
                                    Approved
                                </p>

                                <h3 class="text-3xl font-black text-green-300 mt-2">
                                    {{ approvedCourses }}
                                </h3>

                            </div>

                            <!-- PENDING -->
                            <div class="bg-white/10 border border-white/10 rounded-2xl p-4 text-center">

                                <p class="text-xs text-blue-100">
                                    Pending
                                </p>

                                <h3 class="text-3xl font-black text-yellow-300 mt-2">
                                    {{ pendingCourses }}
                                </h3>

                            </div>

                            <!-- REJECTED -->
                            <div class="bg-white/10 border border-white/10 rounded-2xl p-4 text-center">

                                <p class="text-xs text-blue-100">
                                    Rejected
                                </p>

                                <h3 class="text-3xl font-black text-red-300 mt-2">
                                    {{ rejectedCourses }}
                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= CONTENT ================= -->
    <section class="px-6 lg:px-12 py-10">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>

                <h2 class="text-3xl font-black text-gray-800">
                    Recent Courses
                </h2>

                <p class="text-gray-500 mt-2">
                    Recently created courses and learning materials
                </p>

            </div>
<button
                @click="$inertia.visit('/teacher/courses')"
                class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-semibold hover:bg-blue-700 transition"
            >
                View All
            </button>

        </div>

        <!-- EMPTY -->
        <div
            v-if="recentCourses.length === 0"
            class="bg-white rounded-[35px] p-16 text-center shadow-sm border border-gray-100"
        >

            <img
                src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png"
                class="w-36 mx-auto mb-6"
            />

            <h3 class="text-2xl font-bold text-gray-700">
                No Courses Yet
            </h3>

            <p class="text-gray-400 mt-2">
                Start building your first learning experience
            </p>

        </div>

        <!-- COURSES GRID -->
        <div
            v-else
            class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7"
        >

            <!-- CARD -->
            <div
                v-for="course in recentCourses"
                :key="course.id"
                class="group bg-white rounded-[30px] overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-300 border border-gray-100"
            >

                <!-- IMAGE -->
                <div class="relative overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1200&auto=format&fit=crop"
                        class="w-full h-52 object-cover group-hover:scale-110 transition duration-500"
                    />

                    <!-- STATUS -->
                    <div class="absolute top-4 right-4">

                        <span
                            class="px-4 py-2 rounded-full text-xs font-bold shadow-lg backdrop-blur-xl"
                            :class="{
                                'bg-green-100 text-green-700': course.status === 'approved',
                                'bg-yellow-100 text-yellow-700': course.status === 'pending',
                                'bg-red-100 text-red-700': course.status === 'rejected'
                            }"
                        >
                            {{ course.status }}
                        </span>

                    </div>

                </div>

                <!-- BODY -->
                <div class="p-6">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="bg-blue-100 p-3 rounded-2xl">
                            <BookOpen class="text-blue-600 w-5 h-5"/>
                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-gray-800 line-clamp-1">
                                {{ course.title }}
                            </h3>

                            <p class="text-sm text-gray-400">
                                Online Course
                            </p>

                        </div>

                    </div>

                    <p class="text-gray-500 leading-relaxed text-sm line-clamp-3">
                        {{ course.description }}
                    </p>

                    <!-- FOOTER -->
                    <div class="flex justify-between items-center mt-6 pt-5 border-t">

                        <div class="text-sm text-gray-400">
                            Learning Content
                        </div>

                        <button
                            @click="$inertia.visit(`/teacher/courses/${course.id}`)"
                            class="text-blue-600 font-semibold hover:text-blue-700 transition flex items-center gap-1"
                        >
                            Open
                            <ArrowRight class="w-4 h-4"/>
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

</AdminLayout>
</template>