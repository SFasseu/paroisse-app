<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultatExamen extends Model
{
    use HasFactory;

    protected $table = 'resultats_examens';

    protected $fillable = [
        'catechumene_id',
        'examen_id',
        'note_obtenue',
        'date_examen',
        'statut',
        'observations',
        'enregistre_par',
    ];

    protected $casts = [
        'date_examen'  => 'date',
        'note_obtenue' => 'float',
    ];

    public function catechumene()
    {
        return $this->belongsTo(Catechumene::class);
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function enregistrePar()
    {
        return $this->belongsTo(User::class, 'enregistre_par');
    }

    public function getMentionAttribute()
    {
        $note = $this->note_obtenue;
        $max  = $this->examen ? $this->examen->note_maximale : 20;
        $pct  = ($note / $max) * 100;

        if ($pct >= 90) return 'Excellent';
        if ($pct >= 75) return 'Bien';
        if ($pct >= 60) return 'Assez bien';
        if ($pct >= 50) return 'Passable';
        return 'Insuffisant';
    }
}
