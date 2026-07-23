<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIController extends Controller
{
    /**
     * Handle Chatbot requests using Google Gemini API
     */
    public function chat(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        
        $userMessage = $request->message;
        $apiKey = config('services.gemini.key');

        if ($apiKey) {
            try {
                $systemContext = <<<EOT
Anda adalah OSIS AI Assistant resmi di Website Portal OSIS SMKN 2 Pangkalpinang (SKADA).
Tugas Anda adalah memberikan jawaban yang ramah, santun, inspiratif, dan tepat.

Arahkan siswa ke fitur-fitur resmi yang ada LANGSUNG di website portal ini:
1. Kotak Surat / Suara Siswa (Kirim Saran & Aspirasi):
   - Untuk mengirimkan masukan, saran, atau keluhan, siswa dapat langsung mengisi di menu **Kotak Surat** (URL: /kotak-surat).
   - Daftar aspirasi yang telah ditinjau dan terpublikasi dapat dilihat di menu **Suara Siswa** (URL: /suara-siswa).
2. Menfess OSIS (Pesan Anonim Siswa):
   - Mengirimkan pesan anonim/salam antar siswa di menu **Menfess** (URL: /menfess).
3. E-Voting Pemilos:
   - Pemilihan Ketua & Wakil Ketua OSIS secara online di menu **Pemilos** (URL: /pemilos).
4. E-Pass Tiket QR:
   - Pemesanan tiket masuk event/pensi sekolah di menu **E-Pass Tiket** (URL: /tiketing).
5. Ruang Konseling Online:
   - Konsultasi rahasia bersama pembina/guru BK di menu **Ruang Konseling** (URL: /konseling).
6. Lost & Found (Barang Hilang):
   - Melaporkan atau mencari barang hilang di sekolah di menu **Lost & Found** (URL: /lost-found).
7. Sekbid & Ekstrakurikuler (UKK):
   - Program kerja Sekbid 1-10 di menu **Sekbid** (URL: /sekbid) dan info Ekskul/UKK di menu **UKK** (URL: /ukk).
8. Kalender Event & Dokumentasi Galeri:
   - Agenda kegiatan di menu **Kalender** (URL: /kalender) dan dokumentasi foto di menu **Galeri** (URL: /galeri).
9. Pusat Unduhan Berkas:
   - Download formulir & berkas resmi di menu **Unduhan** (URL: /unduhan).

Aturan Penting:
- Jawablah dengan jelas, ringkas, dan ramah.
- Jika siswa menanyakan cara/tempat mengirimkan masukan/saran/kritik ke web, BERITAHU LANGSUNG bahwa mereka bisa mengisinya di menu **Kotak Surat** (`/kotak-surat`) di website ini tanpa perlu mencari link luar/Instagram.
EOT;

                $prompt = $systemContext . "\n\nPertanyaan siswa: " . $userMessage;

                $models = ['gemini-2.0-flash', 'gemini-flash-latest', 'gemini-2.5-flash-lite'];

                foreach ($models as $model) {
                    $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . $apiKey;

                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->post($endpoint, [
                        'contents' => [
                            [
                                'parts' => [
                                    ['text' => $prompt]
                                ]
                            ]
                        ]
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        $replyText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

                        if ($replyText) {
                            return response()->json(['reply' => trim($replyText)]);
                        }
                    }
                }

            } catch (\Throwable $e) {
                Log::error("Gemini API Error: " . $e->getMessage());
            }
        }

        // Smart Helpful Fallback
        return response()->json([
            'reply' => "Halo! Saya adalah OSIS AI Assistant SMKN 2 Pangkalpinang. Mengenai '$userMessage', kamu dapat membaca selengkapnya pada menu berita/sekbid portal ini, atau menyampaikan aspirasi langsung via Kotak Surat OSIS!"
        ]);
    }

    /**
     * Handle Content Summarization using Gemini API
     */
    public function summarize(Request $request)
    {
        $request->validate(['content' => 'required|string']);

        $content = strip_tags($request->content);
        $apiKey = config('services.gemini.key');

        if ($apiKey) {
            try {
                $prompt = "Buatkan ringkasan singkat (maksimal 2 kalimat) dalam bahasa Indonesia yang menarik dari artikel kegiatan sekolah berikut:\n\n" . $content;
                $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $apiKey;

                $response = Http::post($endpoint, [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $summaryText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    if ($summaryText) {
                        return response()->json(['summary' => trim($summaryText)]);
                    }
                }
            } catch (\Throwable $e) {
                Log::error("Gemini Summarize Error: " . $e->getMessage());
            }
        }

        $summary = "Artikel ini membahas tentang kegiatan sekolah terbaru dengan fokus pada partisipasi siswa dan pengembangan kreativitas di lingkungan SMKN 2 Pangkalpinang.";

        return response()->json(['summary' => $summary]);
    }
}
