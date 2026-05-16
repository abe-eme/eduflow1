<script setup>
import {
  BookOpen,
  Brain,
  Users,
  Sparkles,
  HelpCircle,
  ShieldCheck,
  Zap,
  Radio,
  FileText,
  ChevronDown,
  ArrowRight
} from 'lucide-vue-next'

import { onMounted, ref } from 'vue'
import { Link } from '@inertiajs/vue3'

// Manage FAQ dropdown states smoothly
const activeFaq = ref(null)
const toggleFaq = (index) => {
  activeFaq.value = activeFaq.value === index ? null : index
}

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
  <!-- COMFORTABLE MATTE SLATE THEME (Unified color system matching the login page) -->
  <div class="bg-slate-300 text-slate-800 overflow-x-hidden antialiased selection:bg-slate-700 selection:text-white">

    <!-- NAVIGATION BAR -->
    <nav class="w-full bg-slate-200/80 backdrop-blur border-b border-slate-300 sticky top-0 z-50 transition-all">
      <div class="max-w-7xl mx-auto px-6 md:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
          <span class="p-2 bg-slate-700 rounded-xl font-black text-xl text-white tracking-tight">NL</span>
          <div>
            <h1 class="text-xl font-black text-slate-900 tracking-tight leading-none">NexusLearn</h1>
            <p class="text-[10px] text-slate-600 tracking-wide font-medium mt-0.5">Simple. Fast. Structured.</p>
          </div>
        </div>

        <div class="flex items-center gap-4 md:gap-6 text-sm font-semibold">
          <a href="#about" class="text-slate-600 hover:text-slate-900 transition hidden sm:block">About Us</a>
          <a href="#features" class="text-slate-600 hover:text-slate-900 transition">Features</a>
          <a href="#faq" class="text-slate-600 hover:text-slate-900 transition">Help & FAQ</a>

          <Link
            href="/login"
            class="bg-slate-700 text-white px-4 py-2 rounded-xl hover:bg-slate-800 transition-all duration-200 shadow-sm"
          >
            Sign In
          </Link>
        </div>
      </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative min-h-[85vh] flex items-center overflow-hidden py-12">
      
      <!-- MATTE AMBIENT BACKGROUND LAYER -->
      <div class="absolute inset-0 z-0 bg-gradient-to-tr from-slate-400/30 via-slate-300 to-indigo-900/5"></div>

      <div class="relative z-10 w-full max-w-7xl mx-auto px-6 md:px-8 grid lg:grid-cols-12 gap-12 items-center">

        <!-- LEFT HERO PANEL -->
        <div class="reveal lg:col-span-7 space-y-6">
          <div class="inline-flex items-center gap-2 bg-slate-200 border border-slate-400/40 px-4 py-1.5 rounded-full text-xs font-bold text-slate-700 shadow-sm">
            <Sparkles class="w-3.5 h-3.5 text-slate-600" />
            Easy-to-use e-learning platform
          </div>

          <h1 class="text-4xl sm:text-5xl md:text-6xl font-black leading-tight tracking-tight text-slate-900">
            Learn at your own pace, <br />
            <span class="text-slate-700">
              without internet stress.
            </span>
          </h1>

          <p class="text-slate-600 text-base md:text-lg font-medium leading-relaxed max-w-xl">
            Welcome to NexusLearn. We make online classes simple. Whether your internet connection is fast or slow, our system changes dynamically to keep your dashboard moving along perfectly.
          </p>

          <div class="pt-2 flex flex-wrap gap-4">
            <Link
              href="/register"
              class="bg-slate-700 hover:bg-slate-800 text-white px-8 py-4 rounded-xl font-bold transition-all duration-200 shadow-md transform hover:-translate-y-0.5 text-base"
            >
              Create Account
            </Link>

            <a
              href="#features"
              class="bg-slate-100 border border-slate-400/40 text-slate-700 px-8 py-4 rounded-xl font-bold hover:bg-slate-50 transition-all duration-200 shadow-sm"
            >
              See Features
            </a>
          </div>
        </div>

        <!-- RIGHT HERO PANEL -->
        <div class="reveal lg:col-span-5">
          <div class="bg-slate-200 border border-slate-400/50 rounded-3xl p-6 md:p-8 shadow-xl shadow-slate-400/40 space-y-6">
            <h3 class="text-lg font-black tracking-tight text-slate-900 flex items-center gap-2">
              <Zap class="w-5 h-5 text-slate-700" /> Built for Real Networks
            </h3>

            <div class="space-y-4">
              <div class="flex gap-4">
                <div class="p-2 bg-slate-50 rounded-xl border border-slate-300 text-slate-700 shrink-0 h-10 w-10 flex items-center justify-center shadow-sm">
                  <Radio class="w-5 h-5" />
                </div>
                <div>
                  <h4 class="font-bold text-slate-900 text-sm">Audio-Only Option</h4>
                  <p class="text-slate-600 text-xs mt-0.5 leading-relaxed">Internet connection running slow? Turn off video streams with one quick click to stream audio easily.</p>
                </div>
              </div>

              <div class="flex gap-4">
                <div class="p-2 bg-slate-50 rounded-xl border border-slate-300 text-slate-700 shrink-0 h-10 w-10 flex items-center justify-center shadow-sm">
                  <Brain class="w-5 h-5" />
                </div>
                <div>
                  <h4 class="font-bold text-slate-900 text-sm">Smart AI Study Helper</h4>
                  <p class="text-slate-600 text-xs mt-0.5 leading-relaxed">Instructors generate practice quizzes instantly, and students view straightforward content summaries.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- ABOUT US SECTION -->
    <section id="about" class="py-20 bg-slate-200 border-t border-b border-slate-300 reveal">
      <div class="max-w-4xl mx-auto px-6 text-center space-y-6">
        <span class="text-slate-800 font-bold text-xs uppercase tracking-widest bg-slate-300/80 px-3 py-1 rounded-full border border-slate-400/40">Our Mission</span>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">About NexusLearn</h2>
        <p class="text-slate-700 text-base md:text-lg font-medium leading-relaxed">
          We believe that poor network infrastructure or over-complicated platform designs should never get in the way of structured learning. NexusLearn balances aesthetic tone and system speed, creating an administrative workspace that behaves reliably for platform staff, class teachers, and students simultaneously.
        </p>
      </div>
    </section>

    <!-- CORE FEATURES SECTION -->
    <section id="features" class="py-20 bg-slate-300 reveal">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12 space-y-2">
          <h2 class="text-2xl md:text-3xl font-black tracking-tight text-slate-900">How the Platform Works</h2>
          <p class="text-slate-600 font-medium text-sm max-w-xl mx-auto">Everything you need to keep classroom steps orderly, verified, and plain.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="bg-slate-200 border border-slate-400/40 p-6 rounded-2xl shadow-sm">
            <BookOpen class="w-8 h-8 text-slate-700 mb-4" />
            <h3 class="text-base font-bold text-slate-900 mb-1">Step-by-Step Lessons</h3>
            <p class="text-slate-600 text-xs font-medium leading-relaxed">Class items unlock in chronological order. You must clear Lesson 1 before opening Lesson 2 setup links.</p>
          </div>

          <div class="bg-white border border-slate-300 p-6 rounded-2xl shadow-sm">
            <Users class="w-8 h-8 text-slate-700 mb-4" />
            <h3 class="text-base font-bold text-slate-900 mb-1">Organized Roles</h3>
            <p class="text-slate-600 text-xs font-medium leading-relaxed">Dedicated system dashboards tailored clearly for main Admins, teaching Instructors, and Students.</p>
          </div>

          <div class="bg-slate-200 border border-slate-400/40 p-6 rounded-2xl shadow-sm">
            <FileText class="w-8 h-8 text-slate-700 mb-4" />
            <h3 class="text-base font-bold text-slate-900 mb-1">Quizzes & Papers</h3>
            <p class="text-slate-600 text-xs font-medium leading-relaxed">Submit school assignments, verify quiz outcomes instantly, and inspect clean grading breakdowns.</p>
          </div>

          <div class="bg-white border border-slate-300 p-6 rounded-2xl shadow-sm">
            <ShieldCheck class="w-8 h-8 text-slate-700 mb-4" />
            <h3 class="text-base font-bold text-slate-900 mb-1">Verified Badges</h3>
            <p class="text-slate-600 text-xs font-medium leading-relaxed">Earn pristine, secure completion awards directly inside your dashboard once a track concludes.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- HELP & FREQUENTLY ASKED QUESTIONS SECTION -->
    <section id="faq" class="py-20 bg-slate-200 border-t border-b border-slate-300 reveal">
      <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12 space-y-2">
          <HelpCircle class="w-10 h-10 text-slate-700 mx-auto mb-2" />
          <h2 class="text-2xl md:text-3xl font-black tracking-tight text-slate-900">Help Center & FAQ</h2>
          <p class="text-slate-600 text-sm font-medium">Find straightforward answers regarding system workflows and dashboard permissions.</p>
        </div>

        <!-- FAQ ACCORDION -->
        <div class="space-y-3">
          <div 
            v-for="(faq, index) in [
              { q: 'How do students get access after creating an account?', a: 'Once you submit the registration form, your account goes into an active verification status. You pass a quick confirmation checkpoint to open up student links cleanly.' },
              { q: 'How are instructor dashboard accounts created?', a: 'Instructors cannot sign up on their own to prevent dashboard spam. The designated system administrator issues an invite link straight to the teacher to allow registration.' },
              { q: 'Will this system function well if network bandwidth slows down?', a: 'Yes. NexusLearn uses low-weight page delivery styles. If internet speeds drop, you can trigger our active Audio mode to follow classes without heavy video processing slowdowns.' },
              { q: 'How do learning modules and certificates work?', a: 'As soon as every core chapter component is finished in exact sequence, course test paths activate. Passing benchmarks triggers your official system badge generation onto your dashboard area.' }
            ]" 
            :key="index"
            class="border border-slate-300 rounded-xl overflow-hidden bg-slate-50"
          >
            <button 
              @click="toggleFaq(index)"
              class="w-full text-left px-6 py-4 font-bold text-sm md:text-base flex justify-between items-center text-slate-800 hover:bg-slate-100/60 transition"
            >
              <span>{{ faq.q }}</span>
              <ChevronDown 
                class="w-4 h-4 text-slate-400 transition-transform duration-200 shrink-0 ml-4"
                :class="{ 'rotate-180 text-slate-800 font-bold': activeFaq === index }"
              />
            </button>
            <div 
              v-show="activeFaq === index" 
              class="px-6 pb-5 pt-1 text-xs md:text-sm text-slate-600 border-t border-slate-200 bg-white leading-relaxed animate-fadeIn"
            >
              {{ faq.a }}
            </div>
          </div>
        </div>

        <!-- ADDITIONAL FOOTNOTE SYSTEM BOX -->
        <div class="mt-8 p-4 bg-slate-300 text-slate-700 border border-slate-400/40 rounded-xl text-center text-xs font-bold shadow-sm">
          Encountering internal platform setup bottlenecks? Connect with your local structural system supervisor.
        </div>
      </div>
    </section>

    <!-- CLOSING CTA WINDOW -->
    <section class="py-16 bg-slate-700 text-white text-center relative overflow-hidden reveal">
      <div class="relative z-10 max-w-2xl mx-auto px-6 space-y-6">
        <h2 class="text-2xl md:text-4xl font-black tracking-tight">Ready to start your structured learning?</h2>
        <p class="text-slate-300 text-xs md:text-sm font-medium max-w-md mx-auto">Create a profile or log back into your verified workspace right away.</p>
        <div class="pt-2">
          <Link
            href="/register"
            class="bg-white text-slate-900 px-8 py-3 rounded-xl font-bold hover:bg-slate-100 transition transform hover:-translate-y-0.5 shadow-md text-sm inline-flex items-center gap-2"
          >
            Get Started Now <ArrowRight class="w-4 h-4" />
          </Link>
        </div>
      </div>
    </section>

    <!-- COHESIVE FOOTER -->
    <footer class="bg-slate-800 text-slate-400 py-10 text-xs border-t border-slate-900">
      <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-6">
        <div>
          <div class="flex items-center gap-2 text-white font-bold text-base">
            <span class="p-1.5 bg-slate-700 rounded text-xs border border-slate-600">NL</span> NexusLearn
          </div>
          <p class="mt-1 text-slate-400 font-medium">Accessible education spaces. Managed reliably with Laravel, Vue, and Inertia.</p>
        </div>

        <div class="flex gap-6 text-slate-300 font-bold">
          <Link href="/login" class="hover:text-white transition">Sign In</Link>
          <Link href="/register" class="hover:text-white transition">Register</Link>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-6 text-center mt-6 pt-6 border-t border-slate-700/50 text-[11px] text-slate-500 font-medium">
        © 2026 NexusLearn. Configured for optimized infrastructure setups. All rights reserved.
      </div>
    </footer>

  </div>
</template>

<style scoped>
.reveal {
  opacity: 0;
  transform: translateY(15px);
  transition: opacity 0.5s ease-out, transform 0.5s ease-out;
}

.reveal.active {
  opacity: 1;
  transform: translateY(0);
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-4px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fadeIn {
  animation: fadeIn 0.2s ease-out forwards;
}
</style>