<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfClasseEcole extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'classe_ecole_id'];

    public function professeur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classeEcole()
    {
        return $this->belongsTo(ClasseEcole::class);
    }
}
