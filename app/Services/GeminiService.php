<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey   = config('gemini.api_key');
        $this->baseUrl  = config('gemini.base_url');
        $this->model    = config('gemini.default_model');
    }
    public function generateVideo(string $prompt, string $aspectRatio = '16:9', string $personGeneration = 'allow_all'): ?string
    {
        $url = $this->baseUrl . '/'.$this->model;

        $response = Http::withHeaders([
            'Content-Type'  => 'application/json',
            'x-goog-api-key' => $this->apiKey,
        ])->post($url, [
            'instances' => [[
                'prompt' => $prompt,
            ]],
            'parameters' => [
                'aspectRatio'      => $aspectRatio,
                'personGeneration' => $personGeneration,
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['name'] ?? null;
        } else {
            Log::error('Gemini Video Generation Failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return null;
        }
    }

    /**
     * Vérifie si la génération est terminée
     */
    public function checkOperationStatus(string $operationName): ?array
    {
        $url = $this->baseUrl . '/' . $operationName;

        $response = Http::withHeaders([
            'x-goog-api-key' => $this->apiKey,
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error('Gemini Check Operation Failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return null;
        }
    }

}
