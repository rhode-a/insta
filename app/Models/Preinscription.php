<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preinscription extends Model
{
    protected $fillable = [
    'nom',
    'prenom',
    'email',
    'telephone',
    'niveau',
    'option',
    'valide',
    ];
}
