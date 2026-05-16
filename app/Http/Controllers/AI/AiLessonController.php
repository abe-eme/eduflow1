<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiLessonController extends Controller
{
    /**
     * Process a teacher's prompt and generate structured lesson content.
     */
    public function generateLesson(Request $request)
    {
        // 1. Validate the incoming request from your Vue form
        $request->validate([
            'prompt' => 'required|string|max:1000',
            'type' => 'required|string|in:text,video,audio,image',
        ]);

        $prompt = $request->input('prompt');
        $type = $request->input('type');

        try {
            /**
             * INTEGRATION NOTE: When you are ready to link a live production AI model, 
             * you will place your API call right here. For example, using Gemini:
             * 
             * $response = Http::withHeaders(['Content-Type' => 'application/json'])
             *   ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . env('GEMINI_API_KEY'), [
             *       'contents' => [['parts' => [['text' => "Write a structured lesson script for a {$type} course about: {$prompt}"]]]]
             *   ]);
             * $generatedText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
             */

            // Smart Fallback Generation Engine for immediate testing:
            $generatedText = "### 📚 NexusAI Generated Lesson\n\n" .
                             "**Topic Focus:** " . ucfirst($prompt) . "\n" .
                             "**Optimized Format:** Content structured perfectly for a " . strtoupper($type) . "-based delivery layout.\n\n" .
                             "#### 1. Introduction\n" .
                             "This lesson provides a comprehensive breakdown of " . $prompt . ". Understanding this core architectural concept is essential for mastering advanced development workflows.\n\n" .
                             "#### 2. Key Theoretical Principles\n" .
                             "* **Core Concept A:** Isolation of operational concerns simplifies structural logic.\n" .
                             "* **Core Concept B:** Sequential automation eliminates manual processing bottlenecks.\n\n" .
                             "#### 3. Applied Sandbox Lab Exercise\n" .
                             "Review how these modules link up inside your local workspace environment. Practice modifying the raw files to solidify your understanding of these core components.";

            // 2. Return the text inside a clean JSON response back to your Vue frontend
            return response()->json([
                'generated_text' => $generatedText
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'The AI generator encountered an unexpected processing error.'
            ], 500);
        }
    }
}