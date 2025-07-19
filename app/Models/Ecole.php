<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecole extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'user_id'];

    public function responsable()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classeEcoles()
    {
        return $this->hasMany(ClasseEcole::class);
    }
}
