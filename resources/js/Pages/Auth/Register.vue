<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})
</script>

<template>
  <div class="min-h-screen flex items-center justify-center relative">

    <!-- BACKGROUND IMAGE -->
    <div class="absolute inset-0">
      <img
        src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?q=80&w=2070&auto=format&fit=crop"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-black/60"></div>
      <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/60 to-black/70"></div>
    </div>

    <!-- CARD -->
    <div class="relative z-10 w-full max-w-md p-6">

      <div class="text-center mb-6 text-white">
        <h1 class="text-4xl font-extrabold">Join NexoraLearn</h1>
        <p class="text-white/70 mt-2">Start your structured learning journey</p>
      </div>

      <div class="backdrop-blur-xl bg-white/10 border border-white/20 rounded-3xl p-8 shadow-2xl">

        <h2 class="text-white text-2xl font-bold text-center mb-6">
          Create Account
        </h2>

        <form @submit.prevent="form.post('/register')" class="space-y-4">

          <input
            v-model="form.name"
            type="text"
            placeholder="Full Name"
            class="w-full p-3 rounded-xl bg-white/10 text-white placeholder-white/60 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400"
          />

          <input
            v-model="form.email"
            type="email"
            placeholder="Email"
            class="w-full p-3 rounded-xl bg-white/10 text-white placeholder-white/60 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400"
          />

          <input
            v-model="form.password"
            type="password"
            placeholder="Password"
            class="w-full p-3 rounded-xl bg-white/10 text-white placeholder-white/60 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400"
          />

          <input
            v-model="form.password_confirmation"
            type="password"
            placeholder="Confirm Password"
            class="w-full p-3 rounded-xl bg-white/10 text-white placeholder-white/60 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400"
          />

          <button
            type="submit"
            class="w-full bg-indigo-500 hover:bg-indigo-600 text-white py-3 rounded-xl font-semibold transition"
          >
            Register
          </button>

        </form>

        <p class="text-center text-white/70 mt-6 text-sm">
          Already have an account?
          <Link href="/login" class="text-indigo-300 hover:underline">
            Login here
          </Link>
        </p>

      </div>
    </div>

  </div>
</template>