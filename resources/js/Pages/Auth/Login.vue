<script setup>
import { ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'

const showPassword = ref(false)

const form = useForm({
  email: '',
  password: ''
})
</script>

<template>
  <div class="min-h-screen flex items-center justify-center relative">

    <!-- BACKGROUND -->
    <div class="absolute inset-0">
      <img
        src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-black/70"></div>
      <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/60 to-black/80"></div>
    </div>

    <!-- CARD -->
    <div class="relative z-10 w-full max-w-md p-6">

      <div class="text-center text-white mb-6">
        <h1 class="text-4xl font-extrabold">NexoraLearn</h1>
        <p class="text-white/70 mt-2">Welcome back</p>
      </div>

      <div class="backdrop-blur-xl bg-white/10 border border-white/20 rounded-3xl p-8 shadow-2xl">

        <h2 class="text-white text-2xl font-bold text-center mb-6">
          Login
        </h2>

        <form @submit.prevent="form.post('/login')" class="space-y-4">

          <!-- EMAIL -->
          <input
            v-model="form.email"
            type="email"
            placeholder="Email"
            class="w-full p-3 rounded-xl bg-white/10 text-white placeholder-white/60 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400"
          />

          <!-- PASSWORD WITH SHOW/HIDE -->
          <div class="relative">

            <input
              :type="showPassword ? 'text' : 'password'"
              v-model="form.password"
              placeholder="Password"
              class="w-full p-3 pr-12 rounded-xl bg-white/10 text-white placeholder-white/60 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            />

            <button
              type="button"
              @click="showPassword = !showPassword"
              class="absolute right-3 top-1/2 -translate-y-1/2 text-white/70 hover:text-white"
            >
              👁️
            </button>

          </div>

          <!-- LOGIN BUTTON -->
          <button
            type="submit"
            class="w-full bg-indigo-500 hover:bg-indigo-600 text-white py-3 rounded-xl font-semibold transition"
          >
            Login
          </button>

        </form>

        <!-- LINKS -->
        <div class="mt-5 text-center space-y-2 text-sm">

          <!-- FORGOT PASSWORD -->
          <Link href="/forgot-password" class="text-indigo-300 hover:underline block">
            Forgot Password?
          </Link>

          <!-- REGISTER -->
          <p class="text-white/70">
            Don’t have an account?
            <Link href="/register" class="text-indigo-300 hover:underline">
              Create account
            </Link>
          </p>

        </div>

      </div>
    </div>

  </div>
</template>