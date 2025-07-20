<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Class
 *
 * @property $id
 * @property $nom
 * @property $created_at
 * @property $updated_at
 *
 * @property ClasseEcole[] $classeEcoles
 * @property Elefe[] $eleves
 * @property Video[] $videos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Class extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nom'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classeEcoles()
    {
        return $this->hasMany(\App\Models\ClasseEcole::class, 'id', 'classe_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eleves()
    {
        return $this->hasMany(\App\Models\Elefe::class, 'id', 'classe_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(\App\Models\Video::class, 'id', 'classe_id');
    }
    
}
