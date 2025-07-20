<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class RunWayService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey   = config('runway.api_key2');
        $this->baseUrl  = config('runway.base_url');
        $this->model    = config('runway.default_model');
        Log::info('Clé API utilisée (api_key2) : ' . $this->apiKey);

    }

    /**
     * @summary This endpoint performs a specific action
     * Additional comments can go here.
     */
    public function generateVideo(string $imageUrl, string $promptText, int $duration = 5, string $ratio = '1280:720', $seed = null)
    {
        try {
            $payload = [
                'promptImage' => $imageUrl,
                'promptText' => $promptText,
                'model' => $this->model,
                'duration' => $duration,
                'ratio' => $ratio,
            ];

            if ($seed) {
                $payload['seed'] = $seed;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'X-Runway-Version' => '2024-11-06'
            ])->post("{$this->baseUrl}/image_to_video", $payload);

            if ($response->successful()) {
                return $response->json(); // ou ['status' => 'ok', 'data' => $response->json()]
            } else {
                Log::error('Runway API Error: ' . $response->body());
                return ['error' => 'Erreur API', 'details' => $response->json()];
            }
        } catch (\Exception $e) {
            Log::error('RunwayService Exception: ' . $e->getMessage());
            return ['error' => 'Exception levée', 'message' => $e->getMessage()];
        }
    }
}
