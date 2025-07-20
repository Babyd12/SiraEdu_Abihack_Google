<?php

return [
    'api_key' => env('RUNWAY_API_KEY'),
    'base_url' => env('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models'),
    'default_model' => env('GEMINI_MODEL', 'gen3a_turbo'),
];
