<script setup>
import { reactive, ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    courseId: Number
});

const form = reactive({
    title: '',
    type: 'text',          // Default type selector
    content_body: '',      // Rich text description / AI output
    media_file: null       // Video, Audio, or Image binary file upload
});

const aiPrompt = ref('');
const isGeneratingAi = ref(false);

// Call an API endpoint to generate content using AI
const generateWithAi = async () => {
    if (!aiPrompt.value) return;
    isGeneratingAi.value = true;
    
    try {
        const response = await fetch('/api/ai/generate-lesson', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ prompt: aiPrompt.value, type: form.type })
        });
        const data = await response.json();
        form.content_body = data.generated_text;
    } catch (error) {
        alert('AI Generation failed. Please try again.');
    } finally {
        isGeneratingAi.value = false;
    }
};

// Handle file input changes safely
const handleFileUpload = (event) => {
    form.media_file = event.target.files[0];
};

// Submit the multi-media form to your Laravel backend
const submitLesson = () => {
    // Force Inertia to send data as a Multipart Form to support file uploads
    router.post(route('teacher.lessons.store', props.courseId), form, {
        forceFormData: true
    });
};
</script>

<template>
    <div class="min-h-screen bg-slate-950 text-slate-100 p-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold tracking-tight text-white">Create New Lesson</h1>
                <p class="text-slate-400 text-sm mt-1">Mix AI text generation with high-fidelity raw video and audio uploads.</p>
            </div>

            <!-- Main Creation Form Card -->
            <form @submit.prevent="submitLesson" class="space-y-6 bg-slate-900 border border-slate-800 p-6 rounded-xl shadow-xl">
                <!-- Lesson Title -->
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Lesson Title</label>
                    <input v-model="form.title" type="text" placeholder="e.g., Understanding Middleware Pipelines" class="w-full bg-slate-950 border border-slate-800 focus:border-indigo-500 rounded-lg px-4 py-2.5 text-sm text-slate-200 outline-none transition-colors" required />
                </div>

                <!-- Media Content Type Selector -->
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Primary Material Format</label>
                    <div class="grid grid-cols-4 gap-3">
                        <button v-for="mediaType in ['text', 'video', 'audio', 'image']" :key="mediaType" type="button" @click="form.type = mediaType" :class="[
                            'py-3 text-sm font-medium border rounded-lg uppercase tracking-wider transition-all',
                            form.type === mediaType ? 'bg-indigo-600/20 border-indigo-500 text-indigo-400' : 'bg-slate-950 border-slate-800 text-slate-400 hover:border-slate-700'
                        ]">
                            {{ mediaType }}
                        </button>
                    </div>
                </div>

                <!-- AI Generation Portal Container -->
                <div class="p-4 bg-slate-950 border border-slate-800 rounded-lg">
                    <label class="block text-xs font-semibold text-indigo-400 uppercase tracking-wider mb-2">💡 NexusAI Assistant Tool</label>
                    <div class="flex gap-2">
                        <input v-model="aiPrompt" type="text" placeholder="Explain how user authentication logic flows step by step..." class="flex-1 bg-slate-900 border border-slate-800 focus:border-indigo-500 rounded-lg px-4 py-2 text-sm text-slate-200 outline-none transition-colors" />
                        <button type="button" @click="generateWithAi" :disabled="isGeneratingAi" class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm px-4 rounded-lg transition-colors disabled:opacity-50">
                            {{ isGeneratingAi ? 'Thinking...' : 'Ask AI' }}
                        </button>
                    </div>
                </div>

                <!-- Rich Text Material Content Body -->
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Lesson Body Content</label>
                    <textarea v-model="form.content_body" rows="8" placeholder="Type lesson text or let the AI write it out for you..." class="w-full bg-slate-950 border border-slate-800 focus:border-indigo-500 rounded-lg px-4 py-3 text-sm text-slate-200 font-sans outline-none transition-colors"></textarea>
                </div>

                <!-- File Media Stream Input (Hidden if regular text) -->
                <div v-if="form.type !== 'text'">
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                        Upload Source {{ form.type }} File
                    </label>
                    <input type="file" @change="handleFileUpload" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700 cursor-pointer" />
                </div>

                <!-- Save Action Buttons -->
                <div class="flex justify-end pt-4 border-t border-slate-800 gap-3">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm px-6 py-2.5 rounded-lg transition-colors shadow-md">
                        Publish Lesson
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>