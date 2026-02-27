<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catechiste extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'telephone',
        'email',
        'date_naissance',
        'date_engagement',
        'specialite',
        'photo',
        'actif',
    ];

    protected $casts = [
        'date_naissance'  => 'date',
        'date_engagement' => 'date',
        'actif'           => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function groupes()
    {
        return $this->belongsToMany(GroupeCatechese::class, 'groupe_catechese_catechiste')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
