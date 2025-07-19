<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseEcole extends Model
{
    use HasFactory;
    protected $fillable = ['ecole_id', 'classe_id'];

    public function ecole()
    {
        return $this->belongsTo(Ecole::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function professeurs()
    {
        return $this->hasMany(ProfClasseEcole::class);
    }
}
