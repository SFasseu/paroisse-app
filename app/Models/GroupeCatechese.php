<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeCatechese extends Model
{
    use HasFactory;

    protected $table = 'groupes_catechese';

    protected $fillable = [
        'niveau_formation_id',
        'nom',
        'annee_pastorale',
        'lieu_reunion',
        'jour_reunion',
        'heure_reunion',
        'capacite_max',
        'actif',
    ];

    protected $casts = [
        'heure_reunion' => 'string',
        'actif' => 'boolean',
    ];

    public function niveauFormation()
    {
        return $this->belongsTo(NiveauFormation::class);
    }

    public function catechumenes()
    {
        return $this->hasMany(Catechumene::class);
    }

    public function catechistes()
    {
        return $this->belongsToMany(Catechiste::class, 'groupe_catechese_catechiste')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function getNombreCatechumenes()
    {
        return $this->catechumenes()->whereIn('statut', ['inscrit', 'en_cours'])->count();
    }
}
