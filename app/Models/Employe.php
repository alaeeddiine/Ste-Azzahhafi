<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = [
        'nom',
        'age',
        'salaire',
        'poste',
        'date_embauche',
        'horaire_debut',
        'horaire_fin',
    ];
}
