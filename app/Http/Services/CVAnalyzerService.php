<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;

class CVAnalyzerService
{
    protected $fastApiUrl;

    public function __construct()
    {
        $this->fastApiUrl = config('services.fastapi.url') . '/predict';
    }

    public function analyze(UploadedFile $file)
    {
        try {
            $response = Http::timeout(120)   // Tăng timeout vì OCR + RoBERTa
                ->attach(
                    'file', 
                    $file->get(), 
                    $file->getClientOriginalName(),
                    ['Content-Type' => $file->getMimeType()]
                )
                ->post($this->fastApiUrl);

            if ($response->failed()) {
                throw new \Exception('FastAPI Error: ' . $response->body());
            }

            $result = $response->json();

            if (isset($result['error'])) {
                throw new \Exception($result['error']);
            }

            return $result;

        } catch (\Exception $e) {
            throw new \Exception('Lỗi phân tích CV: ' . $e->getMessage());
        }
    }
}