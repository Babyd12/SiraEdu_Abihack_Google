<?php

namespace App\Http\Controllers;

use App\Models\video;
use Illuminate\Http\Request;
use App\Services\GeminiService;
use App\Http\Requests\VideoRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function store(VideoRequest $request)
    {
        try{
            $user = Auth::user();
            //  $langue=$request->langue;
    
            $prompt = $request->input('prompt');
            $aspectRatio = $request->input('aspect_ratio', '16:9');
     // 'langue' => $request->langue,
            $videoData = $this->geminiService->generateVideo($prompt,$aspectRatio);
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

        }catch(\Exception $e){
            Log::error('Video Generation Error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => Auth::id(),
            ]);
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }

}
