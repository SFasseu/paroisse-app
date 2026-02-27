<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauFormation extends Model
{
    use HasFactory;

    protected $table = 'niveaux_formation';

    protected $fillable = [
        'nom',
        'description',
        'ordre',
        'duree_mois',
        'age_minimum',
        'actif',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

    public function groupesCatechese()
    {
        return $this->hasMany(GroupeCatechese::class);
    }

    public function progressions()
    {
        return $this->hasMany(ProgressionCatechumene::class);
    }

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre');
    }
}
