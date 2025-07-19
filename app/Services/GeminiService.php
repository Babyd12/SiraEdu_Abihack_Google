<?php

namespace App\Services;

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
      public function generateVideo1(string $prompt, string $aspectRatio = '16:9'): ?string
    {
        $response = Http::withHeaders([
            'x-goog-api-key' => $this->apiKey,
            'Content-Type'   => 'application/json',
        ])->post("{$this->baseUrl}/{$this->model}", [
            'instances' => [[
                'prompt' => $prompt
            ]],
            'parameters' => [
                'aspectRatio' => '16:9',
                'personGeneration' => 'allow_all',
            ],
        ]);

        if ($response->successful()) {
            return $response->json('name'); // operation name
        }

        return null;
    }

   public function checkOperationStatus(string $operationName): ?array
    {
        $url = "{$this->baseUrl}/{$operationName}";
        $response = Http::withHeaders([
            'x-goog-api-key' => $this->apiKey,
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }


}
