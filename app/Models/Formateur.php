<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'matricule',
        'nom',
        'prenom',
        'email',
        'telephone',
        'user_id',
    ];

    public function options()
    {
        return $this->belongsToMany(Option::class);
    }
    // Calcule total des heures
    public function totalHeures()
    {
        return $this->cours()->sum('heures');
    }

    // Calcule montant (5000 FCFA/heure)
    public function montantMensuel()
    {
        return $this->totalHeures() * 5000;
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function heuresTotal()
    {
        return $this->cours()->sum('nombre_heures');
    }

    public function salaireMensuel($mois)
    {
        return $this->cours()
            ->whereMonth('date', $mois)
            ->sum('nombre_heures') * 5000;
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($formateur) {
            if (empty($formateur->matricule)) {
                $formateur->matricule = self::generateMatricule();
            }
        });
    }

    public static function generateMatricule()
    {
        $prefix = 'FRM';
        $year = date('Y');

        $last = self::latest('id')->first();
        $nextId = $last ? $last->id + 1 : 1;

        return $prefix . '-' . $year . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
