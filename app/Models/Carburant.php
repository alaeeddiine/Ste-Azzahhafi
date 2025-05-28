<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carburant extends Model
{
    protected $fillable = ['type', 'operation', 'quantite', 'fournisseur', 'date'];
    
}
