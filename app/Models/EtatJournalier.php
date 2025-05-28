<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtatJournalier extends Model
{
    protected $fillable = [
    'date', 'volume_essence', 'volume_diesel',
    'prix_litre_essence', 'prix_litre_diesel',
    'recette_lavage', 'recette_urgence',
    'depenses_credits', 'depenses_autres',
    ];

}
