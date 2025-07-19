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

}
