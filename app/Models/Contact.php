<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Permet l'insertion et la modification des champs
    protected $fillable = ['name', 'email', 'adresse', 'phone'];
}
