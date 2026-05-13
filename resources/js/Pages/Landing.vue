 <!-- resources/js/Pages/Landing.vue -->

<script setup>
import {
  BookOpen,
  Brain,
  Users,
  Sparkles,
  GraduationCap,
  Globe,
  ShieldCheck,
  BarChart3
} from 'lucide-vue-next'

import { onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'


onMounted(() => {
  const elements = document.querySelectorAll('.reveal')

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('active')
        }
      })
    },
    { threshold: 0.1 }
  )

  elements.forEach((el) => observer.observe(el))
})
</script>

<template>
  <div class="bg-white text-gray-900 overflow-x-hidden">

    <!-- HERO -->
    <section class="relative min-h-screen flex items-center">

      <!-- BACKGROUND -->
      <div class="absolute inset-0">
        <img
          src="https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=2070&auto=format&fit=crop"
          class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-black/70"></div>
      </div>

      <div class="relative z-10 w-full">

        <!-- NAV -->
        <nav class="max-w-7xl mx-auto px-8 py-6 flex justify-between items-center text-white">

          <div>
            <h1 class="text-3xl font-extrabold tracking-wide">
              NexoraLearn
            </h1>

            <p class="text-sm text-gray-300">
              Structured learning for every student
            </p>
          </div>

          <div class="hidden md:flex items-center gap-8">
            <a href="#features" class="hover:text-indigo-300 transition">Features</a>
            <a href="#how" class="hover:text-indigo-300 transition">How It Works</a>

            <a
              href="/login"
              class="border border-white px-5 py-2 rounded-xl hover:bg-white hover:text-black transition"
            >
              Login
            </a>
          </div>

        </nav>

        <!-- HERO CONTENT -->
        <div class="max-w-7xl mx-auto px-8 py-24 grid lg:grid-cols-2 gap-16 items-center">

          <!-- LEFT -->
          <div class="text-white reveal">

            <span class="bg-indigo-500/20 text-indigo-200 px-4 py-2 rounded-full text-sm">
              Modern Learning Platform
            </span>

            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mt-6">
              Learn at your own pace.
              <br />
              Anytime. Anywhere.
            </h1>

            <p class="text-gray-300 text-lg mt-6 leading-relaxed max-w-xl">
              NexoraLearn helps students and teachers manage structured courses,
              batch-based learning, assignments, and progress tracking in one simple system.
            </p>

            <div class="mt-8 flex flex-wrap gap-4">

              <a
                href="/register"
                class="bg-indigo-500 hover:bg-indigo-600 px-8 py-4 rounded-2xl font-semibold transition shadow-xl"
              >
                Create Account
              </a>

              <a
                href="#features"
                class="border border-white px-8 py-4 rounded-2xl hover:bg-white hover:text-black transition"
              >
                Explore Features
              </a>

            </div>

            <p class="mt-6 text-gray-300">
              Already have an account?
              <a href="/login" class="text-indigo-300 hover:underline">
                Login here
              </a>
            </p>

          </div>

          <!-- RIGHT -->
          <div class="reveal">

            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl p-8 text-white shadow-2xl">

              <h3 class="text-2xl font-bold mb-6">
                Why NexoraLearn Works Better
              </h3>

              <div class="space-y-6">
<div class="flex gap-4">
                  <div class="w-3 h-3 bg-indigo-400 rounded-full mt-2"></div>
                  <div>
                    <h4 class="font-semibold">Structured Learning</h4>
                    <p class="text-gray-300 text-sm">
                      Lessons are organized step-by-step for better understanding.
                    </p>
                  </div>
                </div>

                <div class="flex gap-4">
                  <div class="w-3 h-3 bg-indigo-400 rounded-full mt-2"></div>
                  <div>
                    <h4 class="font-semibold">Batch-Based System</h4>
                    <p class="text-gray-300 text-sm">
                      Students can learn in different groups and schedules.
                    </p>
                  </div>
                </div>

                <div class="flex gap-4">
                  <div class="w-3 h-3 bg-indigo-400 rounded-full mt-2"></div>
                  <div>
                    <h4 class="font-semibold">Teacher Control</h4>
                    <p class="text-gray-300 text-sm">
                      Teachers manage courses, assignments, and student progress.
                    </p>
                  </div>
                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

    <!-- STATS -->
    <section class="py-20 bg-white reveal">

      <div class="max-w-7xl mx-auto px-8">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

          <div>
            <h2 class="text-4xl font-extrabold text-indigo-600">Simple</h2>
            <p class="text-gray-500 mt-2">User Experience</p>
          </div>

          <div>
            <h2 class="text-4xl font-extrabold text-indigo-600">Fast</h2>
            <p class="text-gray-500 mt-2">Lightweight System</p>
          </div>

          <div>
            <h2 class="text-4xl font-extrabold text-indigo-600">Secure</h2>
            <p class="text-gray-500 mt-2">Role-Based Access</p>
          </div>

          <div>
            <h2 class="text-4xl font-extrabold text-indigo-600">Scalable</h2>
            <p class="text-gray-500 mt-2">Multi-Batch Learning</p>
          </div>

        </div>

      </div>

    </section>

    <!-- FEATURES -->
    <section id="features" class="py-24 bg-gray-50 reveal">

      <div class="max-w-7xl mx-auto px-8">

        <div class="text-center mb-16">
          <h2 class="text-4xl font-extrabold">Core Features</h2>
          <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
            Everything you need for a complete learning management system.
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

          <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition">
            <BookOpen class="w-12 h-12 text-indigo-500 mb-5" />
            <h3 class="text-xl font-bold mb-3">Smart Courses</h3>
            <p class="text-gray-600">Lessons, quizzes, and assignments in one flow.</p>
          </div>

          <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition">
            <Users class="w-12 h-12 text-indigo-500 mb-5" />
            <h3 class="text-xl font-bold mb-3">Role System</h3>
            <p class="text-gray-600">Admin, teacher, and student permissions.</p>
          </div>

          <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition">
            <Globe class="w-12 h-12 text-indigo-500 mb-5" />
            <h3 class="text-xl font-bold mb-3">Batch Learning</h3>
            <p class="text-gray-600">Students learn in flexible time groups.</p>
          </div>

          <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition">
            <ShieldCheck class="w-12 h-12 text-indigo-500 mb-5" />
            <h3 class="text-xl font-bold mb-3">Secure System</h3>
            <p class="text-gray-600">Admin approval and controlled access system.</p>
          </div>

        </div>

      </div>

    </section>
 <!-- HOW -->
    <section id="how" class="py-24 bg-white reveal">

      <div class="max-w-7xl mx-auto px-8 text-center">

        <h2 class="text-4xl font-extrabold mb-16">How It Works</h2>

        <div class="grid md:grid-cols-3 gap-8">

          <div class="bg-gray-50 p-8 rounded-3xl">
            <GraduationCap class="w-12 h-12 text-indigo-500 mb-5 mx-auto" />
            <h3 class="text-2xl font-bold mb-3">Register</h3>
            <p class="text-gray-600">Create an account and wait for approval.</p>
          </div>

          <div class="bg-gray-50 p-8 rounded-3xl">
            <Globe class="w-12 h-12 text-indigo-500 mb-5 mx-auto" />
            <h3 class="text-2xl font-bold mb-3">Join Batch</h3>
            <p class="text-gray-600">Enroll in a structured learning batch.</p>
          </div>

          <div class="bg-gray-50 p-8 rounded-3xl">
            <BarChart3 class="w-12 h-12 text-indigo-500 mb-5 mx-auto" />
            <h3 class="text-2xl font-bold mb-3">Track Progress</h3>
            <p class="text-gray-600">Complete lessons and monitor performance.</p>
          </div>

        </div>

      </div>

    </section>

    <!-- CTA -->
    <section class="py-24 bg-indigo-600 text-white text-center reveal">

      <div class="max-w-4xl mx-auto px-8">

        <ShieldCheck class="w-16 h-16 mx-auto mb-6" />

        <h2 class="text-5xl font-extrabold">
          Start Learning Today
        </h2>

        <p class="text-indigo-100 text-lg mt-6">
          Join NexoraLearn and experience structured education.
        </p>

        <div class="mt-10">
          <a
            href="/register"
            class="bg-white text-indigo-600 px-10 py-4 rounded-2xl font-bold hover:scale-105 transition inline-block"
          >
            Get Started
          </a>
        </div>

      </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-black text-gray-400 py-10">

      <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between gap-8">

        <div>
          <h2 class="text-2xl font-bold text-white">NexoraLearn</h2>
          <p class="mt-3 max-w-md">
            A structured learning platform designed for modern education.
          </p>
        </div>

        <div>
          <h3 class="text-white font-semibold mb-3">Quick Links</h3>
          <div class="space-y-2">
            <a href="/" class="block hover:text-white">Home</a>
            <a href="/login" class="block hover:text-white">Login</a>
            <a href="/register" class="block hover:text-white">Register</a>
          </div>
        </div>

      </div>

      <div class="text-center mt-10 text-sm text-gray-500">
        © 2026 NexoraLearn. All rights reserved.
      </div>

    </footer>

  </div>
</template>

<style scoped>
.reveal {
  opacity: 0;
  transform: translateY(40px);
  transition: all 0.8s ease;
}

.reveal.active {
  opacity: 1;
  transform: translateY(0);
}
</style>