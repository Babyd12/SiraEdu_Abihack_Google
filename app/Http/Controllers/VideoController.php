<?php

namespace App\Http\Controllers;

use App\Models\video;
use Illuminate\Http\Request;
use App\Services\GeminiService;

class VideoController extends Controller
{


    public function createVideo1(Request $request)
{
    $prompt = $request->input('prompt');
    $service = new \App\Services\GeminiService();

    $operationId = $service->generateVideo1($prompt);

    return response()->json(['operation_id' => $operationId]);
}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(video $video)
    {
        //
    }

    
}
