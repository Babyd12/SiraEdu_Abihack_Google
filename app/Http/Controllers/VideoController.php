<?php

namespace App\Http\Controllers;

use App\Models\video;
use Illuminate\Http\Request;
use App\Services\GeminiService;
use App\Services\RunWayService;
use App\Http\Requests\VideoRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    protected $geminiService;
    protected $runway;

    public function __construct(GeminiService $geminiService, RunWayService $runway)
    {
        $this->geminiService = $geminiService;
        $this->runway = $runway;
    }






    public function store(VideoRequest $request)
    {
        try {
            $user = Auth::user();
            //  $langue=$request->langue;

            $prompt = $request->input('prompt');
            $aspectRatio = $request->input('aspect_ratio', '16:9');
            // 'langue' => $request->langue,
            $videoData = $this->geminiService->generateVideo($prompt, $aspectRatio);
            dd($videoData);
            if (!isset($videoData['op_name'])) {
                return response()->json(['error' => 'Erreur lors de la génération de la vidéo.'], 500);
            }

            // Enregistrer en base
            $video = Video::create([
                'titre' => $request->titre,
                'prompt' => $prompt,
                'status' => 'processing',
                'operation_name' => $videoData['op_name'],
                'aspect_ratio' => $aspectRatio,
                'langue' => $request->langue,
                'prof_id' => $user->id,
                'classe_id' => $request->classe_id,
                'matiere_id' => $request->matiere_id,
            ]);

            return response()->json([
                'message' => 'Génération de la vidéo en cours.',
                'video_id' => $video->id,
                'operation' => $videoData['op_name']
            ], 202);
        } catch (\Exception $e) {
            Log::error('Video Generation Error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => Auth::id(),
            ]);
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }

    /**
     * @summary This endpoint performs a specific action
     */
    public function v1GenerateVideo(Request $request)
    {
        $request->validate([
            'promptText' => 'required|string|max:500',
            'imageUrl' => 'required|url',
        //    'imageUrl' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'duration' => 'nullable|integer|min:1|max:10',
            'ratio' => 'nullable|string',
            'seed' => 'nullable|integer'
        ]);

        try {
            Log::info('Début de la génération de vidéo', $request->all());

            $response = $this->runway->generateVideo(
                imageUrl: $request->input('imageUrl'),
                promptText: $request->input('promptText'),
                duration: $request->input('duration', 5),
                ratio: $request->input('ratio', '1280:720'),
                seed: $request->input('seed')
            );

            if (isset($response['error'])) {
                Log::error('Erreur retournée par le service Runway', $response);
                return response()->json(['message' => 'Erreur lors de la génération', 'details' => $response], 500);
            }

            Log::info('Vidéo générée avec succès', $response);
            return response()->json(['message' => 'Vidéo générée avec succès', 'data' => $response], 200);
        } catch (\Exception $e) {
            Log::error('Erreur inattendue dans VideoController: ' . $e->getMessage());
            return response()->json(['message' => 'Une erreur est survenue.', 'error' => $e->getMessage()], 500);
        }
    }
}
