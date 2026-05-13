 <script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Users, CheckCircle, Clock, Ban, UserPlus, UsersRound } from 'lucide-vue-next'

defineProps({
    totalUsers: Number,
    activeUsers: Number,
    pendingUsers: Number,
    suspendedUsers: Number,
    recentUsers: Array
})
</script>

<template>
<AdminLayout>

<div class="min-h-screen bg-[#0b1220] text-white">

    <!-- ================= HERO ================= -->
    <section class="relative h-[360px] overflow-hidden">

        <img
            src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=1600&auto=format&fit=crop"
            class="w-full h-full object-cover"
        />

        <div class="absolute inset-0 bg-black/60"></div>

        <div class="absolute inset-0 flex flex-col justify-center px-10">

            <h1 class="text-4xl font-black">
                Admin Control Hub
            </h1>

            <p class="text-white/70 mt-2 max-w-xl">
                Manage users, roles, approvals and system activity in one powerful dashboard.
            </p>

        </div>

    </section>

    <!-- ================= STATS ================= -->
    <section class="px-10 -mt-14 relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- TOTAL -->
            <div class="relative rounded-3xl overflow-hidden h-40 shadow-xl">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=1200"
                     class="absolute w-full h-full object-cover"/>
                <div class="absolute inset-0 bg-blue-900/70"></div>

                <div class="relative p-5 flex flex-col justify-between h-full">
                    <Users class="w-6 h-6"/>
                    <div>
                        <p class="text-sm text-white/70">Total Users</p>
                        <h2 class="text-3xl font-black">{{ totalUsers }}</h2>
                    </div>
                </div>
            </div>

            <!-- ACTIVE -->
            <div class="relative rounded-3xl overflow-hidden h-40 shadow-xl">
                <img src="https://images.unsplash.com/photo-1556155092-490a1ba16284?q=80&w=1200"
                     class="absolute w-full h-full object-cover"/>
                <div class="absolute inset-0 bg-green-900/70"></div>

                <div class="relative p-5 flex flex-col justify-between h-full">
                    <CheckCircle class="w-6 h-6"/>
                    <div>
                        <p class="text-sm text-white/70">Active</p>
                        <h2 class="text-3xl font-black">{{ activeUsers }}</h2>
                    </div>
                </div>
            </div>

            <!-- PENDING -->
            <div class="relative rounded-3xl overflow-hidden h-40 shadow-xl">
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200"
                     class="absolute w-full h-full object-cover"/>
                <div class="absolute inset-0 bg-yellow-900/70"></div>

                <div class="relative p-5 flex flex-col justify-between h-full">
                    <Clock class="w-6 h-6"/>
                    <div>
                        <p class="text-sm text-white/70">Pending</p>
                        <h2 class="text-3xl font-black">{{ pendingUsers }}</h2>
                    </div>
                </div>
            </div>

            <!-- SUSPENDED -->
            <div class="relative rounded-3xl overflow-hidden h-40 shadow-xl">
                <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=1200"
                     class="absolute w-full h-full object-cover"/>
                <div class="absolute inset-0 bg-red-900/70"></div>

                <div class="relative p-5 flex flex-col justify-between h-full">
 <Ban class="w-6 h-6"/>
                    <div>
                        <p class="text-sm text-white/70">Suspended</p>
                        <h2 class="text-3xl font-black">{{ suspendedUsers }}</h2>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- ================= MAIN ================= -->
    <section class="px-10 py-10 grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- RECENT ACTIVITY -->
        <div class="lg:col-span-2">

            <h2 class="text-xl font-bold mb-5">
                Recent Activity
            </h2>

            <div class="space-y-4">

                <div
                    v-for="(user, index) in recentUsers"
                    :key="user.id"
                    class="relative rounded-2xl overflow-hidden p-5 shadow-lg"
                >

                    <!-- DIFFERENT IMAGE PER USER -->
                    <img
                        :src="[
                            'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200',
                            'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200',
                            'https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=1200',
                            'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1200',
                            'https://images.unsplash.com/photo-1556155092-490a1ba16284?q=80&w=1200'
                        ][index % 5]"
                        class="absolute inset-0 w-full h-full object-cover"
                    />

                    <div class="absolute inset-0 bg-black/70"></div>

                    <div class="relative flex justify-between items-center">

                        <div>
                            <p class="font-bold">{{ user.name }}</p>
                            <p class="text-sm text-white/60">{{ user.email }}</p>
                        </div>

                        <span
                            class="text-xs px-3 py-1 rounded-full font-semibold"
                            :class="{
                                'bg-green-500/30 text-green-200': user.status === 'active',
                                'bg-yellow-500/30 text-yellow-200': user.status === 'pending',
                                'bg-red-500/30 text-red-200': user.status === 'suspended'
                            }"
                        >
                            {{ user.status }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- QUICK ACTIONS -->
        <div>

            <h2 class="text-xl font-bold mb-5">
                Quick Actions
            </h2>

            <div class="space-y-4">

                <button
                    @click="$inertia.visit('/admin/users/create')"
                    class="relative overflow-hidden w-full rounded-2xl p-5"
                >
                    <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=1200"
                         class="absolute inset-0 w-full h-full object-cover"/>
                    <div class="absolute inset-0 bg-blue-900/70"></div>
                    <div class="relative flex justify-between items-center">
                        <UserPlus class="w-5 h-5"/>
                        <span>Create User</span>
                    </div>
                </button>

                <button
                    @click="$inertia.visit('/admin/users')"
                    class="relative overflow-hidden w-full rounded-2xl p-5"
                >
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200"
                         class="absolute inset-0 w-full h-full object-cover"/>
 <div class="absolute inset-0 bg-indigo-900/70"></div>
                    <div class="relative flex justify-between items-center">
                        <UsersRound class="w-5 h-5"/>
                        <span>Manage Users</span>
                    </div>
                </button>

            </div>

        </div>

    </section>

</div>

</AdminLayout>
</template>