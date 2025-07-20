<?php

namespace App\Http\Controllers\Api;

use App\Models\Ecole;
use Illuminate\Http\Request;
use App\Http\Requests\EcoleRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EcoleResource;

class EcoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ecoles = Ecole::paginate();

        return EcoleResource::collection($ecoles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EcoleRequest $request): JsonResponse
    {
        $ecole = Ecole::create($request->validated());

        return response()->json(new EcoleResource($ecole));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ecole $ecole): JsonResponse
    {
        return response()->json(new EcoleResource($ecole));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EcoleRequest $request, Ecole $ecole): JsonResponse
    {
        $ecole->update($request->validated());

        return response()->json(new EcoleResource($ecole));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Ecole $ecole): Response
    {
        $ecole->delete();

        return response()->noContent();
    }
}
