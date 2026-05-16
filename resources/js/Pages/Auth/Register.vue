<script setup>
import { ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import { Eye, EyeOff, Lock, Mail, User, ArrowLeft } from 'lucide-vue-next'

const showPassword = ref(false)
const showConfirmPassword = ref(false)

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const submitRegistration = () => {
  form.post('/register', {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <!-- BALANCED MATTE SLATE BACKGROUND (Matches Landing & Login perfectly) -->
  <div class="min-h-screen flex items-center justify-center relative bg-slate-300 overflow-hidden antialiased text-slate-800">
    
    <!-- UNIFIED BACKGROUND ACCENT GRADIENT -->
    <div class="absolute inset-0 z-0 bg-gradient-to-tr from-slate-400/40 via-slate-300 to-indigo-900/10"></div>

    <!-- MAIN FORM WRAPPER -->
    <div class="relative z-10 w-full max-w-md p-6">
      
      <!-- NAVIGATION PORTAL BACK LINK -->
      <div class="mb-6">
        <Link href="/" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-indigo-900 transition">
          <ArrowLeft class="w-3.5 h-3.5" /> Back to home page
        </Link>
      </div>

      <!-- BRAND IDENTIFIER -->
      <div class="text-center mb-6 space-y-2">
        <div class="inline-flex items-center justify-center p-3 bg-slate-700 rounded-2xl font-black text-2xl text-white tracking-tight shadow-md">
          NL
        </div>
        <h1 class="text-3xl font-black tracking-tight text-slate-900">NexusLearn</h1>
        <p class="text-slate-600 text-sm font-medium">Create your profile to start your structured learning journey.</p>
      </div>

      <!-- BALANCED LOW-CONTRAST MATTE CONTAINER CARD -->
      <div class="bg-slate-200 border border-slate-300/80 rounded-3xl p-6 md:p-8 shadow-xl shadow-slate-400/60">
        
        <h2 class="text-slate-900 text-xl font-bold tracking-tight mb-5">
          Create Account 
        </h2>ss

        <form @submit.prevent="submitRegistration" class="space-y-4">

          <!-- FULL NAME FIELD -->
          <div class="space-y-1.5">
            <label class="text-xs font-bold text-slate-600 tracking-wide uppercase">Full Name</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                <User class="w-4 h-4" />
              </span>
              <input
                v-model="form.name"
                type="text"
                placeholder="John Doe"
                required
                class="w-full p-3 pl-11 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-300 focus:outline-none focus:border-slate-500 focus:ring-1 focus:ring-slate-500 transition-all text-sm"
                :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.name }"
              />
            </div>
            <p v-if="form.errors.name" class="text-xs text-red-600 font-medium pt-0.5">{{ form.errors.name }}</p>
          </div>

          <!-- EMAIL ADDRESS FIELD -->
          <div class="space-y-1.5">
            <label class="text-xs font-bold text-slate-600 tracking-wide uppercase">Email Address</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                <Mail class="w-4 h-4" />
              </span>
              <input
                v-model="form.email"
                type="email"
                placeholder="name@example.com"
                required
                class="w-full p-3 pl-11 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-300 focus:outline-none focus:border-slate-500 focus:ring-1 focus:ring-slate-500 transition-all text-sm"
                :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.email }"
              />
            </div>
            <p v-if="form.errors.email" class="text-xs text-red-600 font-medium pt-0.5">{{ form.errors.email }}</p>
          </div>

          <!-- PASSWORD FIELD -->
          <div class="space-y-1.5">
            <label class="text-xs font-bold text-slate-600 tracking-wide uppercase">Password</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                <Lock class="w-4 h-4" />
              </span>
              <input
                :type="showPassword ? 'text' : 'password'"
                v-model="form.password"
                placeholder="••••••••"
                required
                class="w-full p-3 pl-11 pr-12 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-300 focus:outline-none focus:border-slate-500 focus:ring-1 focus:ring-slate-500 transition-all text-sm"
                :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.password }"
              />
              <button
                type="button"
                @click="showPassword = !showPassword"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-700 transition"
              >
                <EyeOff v-if="showPassword" class="w-4 h-4" />
                <Eye v-else class="w-4 h-4" />
              </button>
            </div>
            <p v-if="form.errors.password" class="text-xs text-red-600 font-medium pt-0.5">{{ form.errors.password }}</p>
          </div>

          <!-- CONFIRM PASSWORD FIELD -->
          <div class="space-y-1.5">
            <label class="text-xs font-bold text-slate-600 tracking-wide uppercase">Confirm Password</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                <Lock class="w-4 h-4" />
              </span>
              <input
                :type="showConfirmPassword ? 'text' : 'password'"
                v-model="form.password_confirmation"
                placeholder="••••••••"
                required
                class="w-full p-3 pl-11 pr-12 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-300 focus:outline-none focus:border-slate-500 focus:ring-1 focus:ring-slate-500 transition-all text-sm"
                :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.password_confirmation }"
              />
              <button
                type="button"
                @click="showConfirmPassword = !showConfirmPassword"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-700 transition"
              >
                <EyeOff v-if="showConfirmPassword" class="w-4 h-4" />
                <Eye v-else class="w-4 h-4" />
              </button>
            </div>
            <p v-if="form.errors.password_confirmation" class="text-xs text-red-600 font-medium pt-0.5">{{ form.errors.password_confirmation }}</p>
          </div>

          <!-- SUBMIT ACTION BUTTON -->
          <div class="pt-2">
            <button
              type="submit"
              :disabled="form.processing"
              class="w-full bg-slate-700 hover:bg-slate-800 disabled:bg-slate-500 text-white py-3 rounded-xl font-bold transition-all duration-200 shadow-md text-sm"
            >
              <span v-if="form.processing">Creating account...</span>
              <span v-else>Register</span>
            </button>
          </div>


        </form>

        <!-- RETURNING USER LINK -->
        <div class="mt-6 pt-6 border-t border-slate-300 text-center text-sm">
          <p class="text-slate-600">
            Already have an account?
            <Link href="/login" class="text-slate-900 font-bold hover:text-slate-700 transition ml-1">
              Login here
            </Link>
          </p>
        </div>

      </div>
    </div>

  </div>
</template>