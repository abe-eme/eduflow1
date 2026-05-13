<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    user: Object
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: ''
})

/*
|--------------------------------------------------------------------------
| FIXED SUBMIT (IMPORTANT)
|--------------------------------------------------------------------------
*/

const submit = () => {
    form.put(`/admin/users/${props.user.id}`)
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
        <h1 class="text-2xl font-bold text-gray-800">Edit User</h1>
        <p class="text-sm text-gray-500">Update user information</p>
    </div>

    <!-- CONTENT -->
    <div class="relative grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- FORM -->
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm">

            <!-- HEADER -->
            <div class="px-6 py-4 border-b bg-blue-50 rounded-t-xl">
                <h2 class="font-semibold text-blue-700">User Information</h2>
            </div>

            <!-- FORM BODY -->
            <div class="p-6 space-y-5">

                <div>
                    <label class="text-sm text-gray-600">Full Name</label>
                    <input
                        v-model="form.name"
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg"
                        placeholder="Enter full name"
                    />
                </div>

                <div>
                    <label class="text-sm text-gray-600">Email Address</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg"
                        placeholder="Enter email"
                    />
                </div>

                <div>
                    <label class="text-sm text-gray-600">Password (optional)</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg"
                        placeholder="Leave empty if not changing"
                    />
                </div>

                <!-- BUTTON -->
                <button
                    type="button"
                    @click="submit"
                    :disabled="form.processing"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                    Update User

                </button>

            </div>
        </div>

    </div>

</div>

</AdminLayout>
</template>