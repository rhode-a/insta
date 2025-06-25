<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class);
    }
}
