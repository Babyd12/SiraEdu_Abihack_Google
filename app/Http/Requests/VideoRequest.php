<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
 
    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'prompt' => 'required|string',
            'aspect_ratio' => 'nullable|in:16:9,4:3,1:1,9:16',
            'langue' => 'required|in:fr,en',
            'classe_id' => 'required|exists:classes,id',
            'matiere_id' => 'required|exists:matieres,id',
            'professeur_id' => 'required|exists:users,id',
        ];
    }
}
