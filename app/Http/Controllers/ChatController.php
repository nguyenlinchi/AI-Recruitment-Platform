<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message', '');
        if (!$message) {
            return response()->json(['reply' => 'Bạn chưa nhập câu hỏi'], 400);
        }

        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        try {
            // Gọi API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $message]
                        ]
                    ]
                ]
            ]);

            // Log raw response để debug (xem storage/logs/laravel.log)
            $raw = $response->json();
            Log::info('Gemini raw response', ['raw' => $raw]);

            // Tìm text theo các cấu trúc khác nhau
            $reply = null;
            if (!empty($raw['candidates'][0]['content']['parts'][0]['text'])) {
                $reply = $raw['candidates'][0]['content']['parts'][0]['text'];
            } elseif (!empty($raw['outputs'][0]['content']['text'])) {
                $reply = $raw['outputs'][0]['content']['text'];
            } elseif (!empty($raw['outputs'][0]['content'][0]['text'])) {
                $reply = $raw['outputs'][0]['content'][0]['text'];
            } elseif (!empty($raw['text'])) {
                $reply = $raw['text'];
            }

            if (!$reply) {
                // Trả cả raw để bạn kiểm tra (chỉ debug local)
                return response()->json([
                    'reply' => 'Không nhận được text từ Gemini',
                    'raw' => $raw
                ], 200);
            }

            return response()->json(['reply' => $reply], 200);
        } catch (\Exception $e) {
            Log::error('Gemini API error: ' . $e->getMessage());
            return response()->json(['reply' => 'Lỗi gọi Gemini: ' . $e->getMessage()], 500);
        }
    }
}
