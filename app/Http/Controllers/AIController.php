<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    /**
     * Handle Chatbot requests
     */
    public function chat(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        
        $userMessage = $request->message;

        // Placeholder for Gemini API Integration
        // In a real scenario, you would use: Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . config('services.gemini.key'), [...])
        
        $response = "Halo! Saya adalah OSIS AI Assistant SMKN 2 Pangkalpinang. Saat ini saya dalam mode simulasi. Anda bertanya: '$userMessage'. Segera saya akan bisa menjawab pertanyaan tentang jadwal sekolah, ekskul, dan lainnya secara pintar!";

        return response()->json(['reply' => $response]);
    }

    /**
     * Handle Content Summarization
     */
    public function summarize(Request $request)
    {
        $request->validate(['content' => 'required|string']);

        $content = strip_tags($request->content);
        
        // Placeholder for AI Summarization
        $summary = "Summary (AI Simulated): Artikel ini membahas tentang kegiatan sekolah terbaru dengan fokus pada partisipasi siswa dan pengembangan kreativitas di lingkungan SMKN 2 Pangkalpinang.";

        return response()->json(['summary' => $summary]);
    }
}
