<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { router, Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const props = defineProps({
    users: Array
})

const search = ref('')

const filteredUsers = computed(() => {
    return props.users.filter(user =>
        user.name.toLowerCase().includes(search.value.toLowerCase()) ||
        user.email.toLowerCase().includes(search.value.toLowerCase())
    )
})

/*
|--------------------------------------------------------------------------
| ACTIONS
|--------------------------------------------------------------------------
*/

// ✅ Toggle active / suspended
const toggleStatus = (id) => {
    router.post(`/admin/users/${id}/toggle-status`, {}, {
        onSuccess: () => router.reload()
    })
}

// ✅ Delete user
const deleteUser = (id) => {
    if (confirm('Are you sure you want to delete this user?')) {
        router.delete(`/admin/users/${id}`, {
            onSuccess: () => router.reload()
        })
    }
}
</script>

<template>
<AdminLayout>

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">User Management</h1>

        <Link
            href="/admin/users/create"
            class="bg-blue-600 text-white px-4 py-2 rounded">
            + Create User
        </Link>

    </div>

    <!-- SEARCH -->
    <input
        v-model="search"
        placeholder="Search by name or email..."
        class="w-full mb-4 p-2 border rounded"
    />

    <!-- TABLE -->
    <div class="bg-white shadow rounded overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>

                <tr v-for="user in filteredUsers" :key="user.id" class="border-t">

                    <td class="p-3">{{ user.name }}</td>
                    <td class="p-3">{{ user.email }}</td>
                    <td class="p-3">{{ user.role }}</td>

                    <td class="p-3">
                        <span
                            :class="user.status === 'active'
                                ? 'text-green-600'
                                : 'text-red-600'">
                            {{ user.status }}
                        </span>
                    </td>

                    <td class="p-3 flex gap-4">

                        <!-- TOGGLE STATUS -->
                        <button
                            @click="toggleStatus(user.id)"
                            class="text-blue-600 hover:underline">
                            {{ user.status === 'active' ? 'Suspend' : 'Activate' }}
                        </button>

                        <!-- EDIT -->
                        <Link
                            :href="`/admin/users/${user.id}/edit`"
                            class="text-yellow-600 hover:underline">
                            Edit
                        </Link>

                        <!-- DELETE -->
                        <button
                            @click="deleteUser(user.id)"
                            class="text-red-600 hover:underline">
                            Delete
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</AdminLayout>
</template>