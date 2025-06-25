<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'formateur_id',
        'matiere_id',
        'option_id',
        'intitule',
        'nombre_heures',
        'date',
    ];

    protected $dates = ['date']; 
    protected $casts = [
    'date' => 'date',
    ];


    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

}
