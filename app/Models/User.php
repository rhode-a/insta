<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Roles possibles (optionnel mais utile pour centraliser)
    public const ROLE_ADMIN = 'admin';
    public const ROLE_ETUDIANT = 'etudiant';
    public const ROLE_FORMATEUR = 'formateur';
    public const ROLE_PARENT = 'parent';

    /**
     * Les champs autorisés en mass assignment
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // rôle de l'utilisateur : admin, etudiant, formateur, parent
    ];

    /**
     * Champs cachés pour les tableaux et JSON (ex: API)
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts pour convertir automatiquement les champs
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Vérifie si l'utilisateur est admin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Vérifie si l'utilisateur est étudiant
     */
    public function isEtudiant(): bool
    {
        return $this->role === self::ROLE_ETUDIANT;
    }

    /**
     * Vérifie si l'utilisateur est formateur
     */
    public function isFormateur(): bool
    {
        return $this->role === self::ROLE_FORMATEUR;
    }

    public function formateur()
    {
        return $this->hasOne(Formateur::class);
    }
    /**
     * Vérifie si l'utilisateur est parent
     */
    public function isParent(): bool
    {
        return $this->role === self::ROLE_PARENT;
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}
