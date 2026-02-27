<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catechumene extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'groupe_catechese_id',
        'numero_dossier',
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'nationalite',
        'adresse',
        'telephone',
        'email',
        'photo',
        'religion_actuelle',
        'statut_matrimonial',
        'profession',
        'date_inscription',
        'statut',
        'observations',
    ];

    protected $casts = [
        'date_naissance'  => 'date',
        'date_inscription' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($catechumene) {
            if (empty($catechumene->numero_dossier)) {
                $annee = date('Y');
                $count = static::whereYear('created_at', $annee)->count() + 1;
                $catechumene->numero_dossier = 'CAT-' . $annee . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function groupeCatechese()
    {
        return $this->belongsTo(GroupeCatechese::class);
    }

    public function parentsTuteurs()
    {
        return $this->hasMany(ParentTuteur::class);
    }

    public function progressions()
    {
        return $this->hasMany(ProgressionCatechumene::class);
    }

    public function resultatsExamens()
    {
        return $this->hasMany(ResultatExamen::class);
    }

    public function sacrements()
    {
        return $this->hasMany(Sacrement::class);
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_naissance)->age;
    }

    public function getStatutLabelAttribute()
    {
        $labels = [
            'inscrit'   => 'Inscrit',
            'en_cours'  => 'En cours',
            'suspendu'  => 'Suspendu',
            'diplome'   => 'Diplômé',
            'abandonne' => 'Abandonné',
        ];
        return $labels[$this->statut] ?? $this->statut;
    }

    public function getStatutColorAttribute()
    {
        $colors = [
            'inscrit'   => 'primary',
            'en_cours'  => 'success',
            'suspendu'  => 'warning',
            'diplome'   => 'info',
            'abandonne' => 'danger',
        ];
        return $colors[$this->statut] ?? 'secondary';
    }
}
