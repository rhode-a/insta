<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'telephone',
        'option_id',
        'niveau_id',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function moyenne()
    {
        $notes = $this->notes;
        $totalCoeffs = $notes->sum('coefficient');
        if ($totalCoeffs == 0) return 0;
        $total = 0;
        foreach ($notes as $note) {
            $total += $note->valeur * $note->coefficient;
        }
        return round($total / $totalCoeffs, 2);
    }
    public function mention()
    {
        $moy = $this->moyenne();

        if ($moy >= 16) return "Très bien";
        if ($moy >= 14) return "Bien";
        if ($moy >= 12) return "Assez bien";
        if ($moy >= 10) return "Passable";
        return "Insuffisant";
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($etudiant) {
            if (empty($etudiant->matricule)) {
                $etudiant->matricule = self::generateMatricule();
            }
        });
    }

    public static function generateMatricule()
    {
        $prefix = 'ETD';
        $year = date('Y');

        $last = self::latest('id')->first();
        $nextId = $last ? $last->id + 1 : 1;

        return $prefix . '-' . $year . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

}
