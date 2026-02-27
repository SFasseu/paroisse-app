<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'niveau_formation_id',
        'titre',
        'description',
        'objectifs',
        'duree_heures',
        'ordre',
        'materiel_requis',
        'actif',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'duree_heures' => 'float',
    ];

    public function niveauFormation()
    {
        return $this->belongsTo(NiveauFormation::class);
    }

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre');
    }
}
