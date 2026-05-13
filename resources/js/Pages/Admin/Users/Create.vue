<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    email: '',
    password: '',
    role: 'teacher' // ✅ ALWAYS TEACHER
})

const submit = () => {
    form.post('/admin/users')
}
</script>

<template>
<AdminLayout>

<div class="min-h-screen relative bg-slate-50 overflow-hidden p-6">

    <!-- BACKGROUND -->
    <div class="absolute inset-0">
        <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- HEADER -->
    <div class="relative mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create Teacher</h1>
        <p class="text-sm text-gray-500">Add a new teacher to the system</p>
    </div>

    <!-- CONTENT -->
    <div class="relative grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- FORM -->
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm">

            <!-- HEADER -->
            <div class="px-6 py-4 border-b bg-blue-50 rounded-t-xl">
                <h2 class="font-semibold text-blue-700">Teacher Information</h2>
            </div>

            <!-- FORM BODY -->
            <div class="p-6 space-y-5">

                <div>
                    <label class="text-sm text-gray-600">Full Name</label>
                    <input
                        v-model="form.name"
                        class="w-full mt-1 p-3 border rounded-lg"
                        placeholder="Enter full name"
                    />
                </div>

                <div>
                    <label class="text-sm text-gray-600">Email Address</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="w-full mt-1 p-3 border rounded-lg"
                        placeholder="Enter email"
                    />
                </div>

                <div>
                    <label class="text-sm text-gray-600">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="w-full mt-1 p-3 border rounded-lg"
                        placeholder="Enter password"
                    />
                </div>

                <!-- OPTIONAL DISPLAY ONLY (NOT EDITABLE) -->
                <div>
                    <label class="text-sm text-gray-600">Role</label>
                    <input
                        value="Teacher"
                        disabled
                        class="w-full mt-1 p-3 border rounded-lg bg-gray-100 text-gray-600"
                    />
                </div>

                <button
                    @click="submit"
                    :disabled="form.processing"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">

                    Create Teacher

                </button>

            </div>
        </div>

    </div>

</div>

</AdminLayout>
</template>