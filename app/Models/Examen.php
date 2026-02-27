<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'niveau_formation_id',
        'titre',
        'description',
        'type',
        'note_maximale',
        'note_passage',
        'date_examen',
        'actif',
    ];

    protected $casts = [
        'date_examen' => 'date',
        'note_maximale' => 'float',
        'note_passage' => 'float',
        'actif' => 'boolean',
    ];

    public function niveauFormation()
    {
        return $this->belongsTo(NiveauFormation::class);
    }

    public function resultats()
    {
        return $this->hasMany(ResultatExamen::class);
    }

    public function getStatutAttribute()
    {
        if (!$this->date_examen) {
            return 'planifié';
        }
        return $this->date_examen->isPast() ? 'passé' : 'à venir';
    }

    public function getTypeLabelAttribute()
    {
        $labels = [
            'ecrit'    => 'Écrit',
            'oral'     => 'Oral',
            'pratique' => 'Pratique',
            'mixte'    => 'Mixte',
        ];
        return $labels[$this->type] ?? $this->type;
    }
}
