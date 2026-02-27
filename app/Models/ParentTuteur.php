<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentTuteur extends Model
{
    use HasFactory;

    protected $table = 'parents_tuteurs';

    protected $fillable = [
        'user_id',
        'catechumene_id',
        'nom',
        'prenom',
        'lien',
        'telephone',
        'email',
        'profession',
        'adresse',
    ];

    public function catechumene()
    {
        return $this->belongsTo(Catechumene::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getLienLabelAttribute()
    {
        $labels = [
            'pere'   => 'Père',
            'mere'   => 'Mère',
            'tuteur' => 'Tuteur',
            'autre'  => 'Autre',
        ];
        return $labels[$this->lien] ?? $this->lien;
    }
}
