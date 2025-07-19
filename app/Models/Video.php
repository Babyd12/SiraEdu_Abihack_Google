<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'url',
        'matiere_id',
        'classe_id',
        'langue',
        'professeur_id'
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function professeur()
    {
        return $this->belongsTo(User::class, 'professeur_id');
    }
}
