<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressionCatechumene extends Model
{
    use HasFactory;

    protected $table = 'progressions_catechumene';

    protected $fillable = [
        'catechumene_id',
        'niveau_formation_id',
        'date_debut',
        'date_fin',
        'statut',
        'note_finale',
        'valide',
        'valide_par',
        'date_validation',
        'commentaires',
    ];

    protected $casts = [
        'date_debut'      => 'date',
        'date_fin'        => 'date',
        'date_validation' => 'date',
        'valide'          => 'boolean',
        'note_finale'     => 'float',
    ];

    public function catechumene()
    {
        return $this->belongsTo(Catechumene::class);
    }

    public function niveauFormation()
    {
        return $this->belongsTo(NiveauFormation::class);
    }

    public function validePar()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }

    public function getStatutLabelAttribute()
    {
        $labels = [
            'en_cours'   => 'En cours',
            'termine'    => 'Terminé',
            'abandonne'  => 'Abandonné',
            'en_attente' => 'En attente',
        ];
        return $labels[$this->statut] ?? $this->statut;
    }
}
