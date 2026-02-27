<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sacrement extends Model
{
    use HasFactory;

    protected $table = 'sacrements';

    protected $fillable = [
        'catechumene_id',
        'type_sacrement',
        'date_sacrement',
        'lieu_sacrement',
        'pretre_officiant',
        'parrain',
        'marraine',
        'numero_registre',
        'observations',
    ];

    protected $casts = [
        'date_sacrement' => 'date',
    ];

    public function catechumene()
    {
        return $this->belongsTo(Catechumene::class);
    }

    public function getTypeLabelAttribute()
    {
        $labels = [
            'bapteme'           => 'Baptême',
            'premiere_communion' => 'Première Communion',
            'confirmation'      => 'Confirmation',
            'mariage'           => 'Mariage',
            'ordre'             => 'Ordre',
        ];
        return $labels[$this->type_sacrement] ?? $this->type_sacrement;
    }
}
