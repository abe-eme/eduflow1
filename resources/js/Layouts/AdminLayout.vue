<script setup>
import { Link, router, usePage } from '@inertiajs/vue3'
import { LayoutDashboard, Users, LogOut } from 'lucide-vue-next'

const logout = () => {
    router.post('/logout')
}

const page = usePage()
const user = page.props.auth?.user
</script>

<template>
<div class="min-h-screen flex bg-gray-100">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col shadow-lg">

        <!-- LOGO -->
        <div class="p-5 text-xl font-bold border-b border-gray-700">
            EduFlow
        </div>

        <!-- NAV -->
        <nav class="flex-1 p-4 space-y-2">

            <!-- DASHBOARD -->
            <Link
                :href="user?.role === 'admin'
                    ? '/admin/dashboard'
                    : user?.role === 'teacher'
                        ? '/teacher/dashboard'
                        : '/student/dashboard'"
                :class="[
                    'flex items-center gap-3 p-2 rounded transition',
                    page.url.includes('dashboard')
                        ? 'bg-blue-600'
                        : 'hover:bg-gray-700'
                ]"
            >
                <LayoutDashboard size="18"/>
                Dashboard
            </Link>

            <!-- ADMIN USERS -->
            <Link
                v-if="user?.role === 'admin'"
                href="/admin/users"
                :class="[
                    'flex items-center gap-3 p-2 rounded transition',
                    page.url.includes('users')
                        ? 'bg-blue-600'
                        : 'hover:bg-gray-700'
                ]"
            >
                <Users size="18"/>
                Users
            </Link>

            <!-- ADMIN COURSES -->
            <Link
                v-if="user?.role === 'admin'"
                href="/admin/courses"
                :class="[
                    'flex items-center gap-3 p-2 rounded transition',
                    page.url.includes('admin/courses')
                        ? 'bg-blue-600'
                        : 'hover:bg-gray-700'
                ]"
            >
                📚 Courses
            </Link>

            <!-- TEACHER COURSES -->
            <Link
                v-if="user?.role === 'teacher'"
                href="/teacher/courses"
                :class="[
                    'flex items-center gap-3 p-2 rounded transition',
                    page.url.includes('teacher/courses')
                        ? 'bg-blue-600'
                        : 'hover:bg-gray-700'
                ]"
            >
                📚 Courses
            </Link>

            <!-- ❌ FIX: REMOVE WRONG GLOBAL ASSIGNMENTS LINK -->
            <!-- Assignments are inside each course -->

            <!-- STUDENT EXPLORE -->
            <Link
                v-if="user?.role === 'student'"
                href="/student/courses"
                :class="[
                    'flex items-center gap-3 p-2 rounded transition',
                    page.url.includes('student/courses')
                        ? 'bg-blue-600'
                        : 'hover:bg-gray-700'
                ]"
            >
                📚 Explore Courses
            </Link>

            <!-- STUDENT MY COURSES -->
            <Link
                v-if="user?.role === 'student'"
                href="/student/my-courses"
                :class="[
                    'flex items-center gap-3 p-2 rounded transition',
                    page.url.includes('my-courses')
                        ? 'bg-blue-600'
                        : 'hover:bg-gray-700'
                ]"
            >
                🎓 My Courses
            </Link>

        </nav>

        <!-- LOGOUT -->
        <div class="p-4 border-t border-gray-700">

            <button
                @click="logout"
                class="flex items-center gap-2 w-full bg-red-500 hover:bg-red-600 p-2 rounded"
            >
                <LogOut size="16"/>
                Logout
            </button>

        </div>

    </aside>
    <!-- MAIN CONTENT -->
    <div class="flex-1">
        <slot />
    </div>

</div>
</template>