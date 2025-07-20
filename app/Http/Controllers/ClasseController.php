<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClasseRequest;
use App\Http\Resources\ClasseResource;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classes = Classe::paginate();

        return ClasseResource::collection($classes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClasseRequest $request): JsonResponse
    {
        $class = Classe::create($request->validated());

        return response()->json(new ClasseResource($class));
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $class): JsonResponse
    {
        return response()->json(new ClasseResource($class));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClasseRequest $request, Classe $class): JsonResponse
    {
        $class->update($request->validated());

        return response()->json(new ClasseResource($class));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Classe $class): Response
    {
        $class->delete();

        return response()->noContent();
    }
}
