<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'nom_utilisateur',
        'prenom_utilisateur',
        'email_utilisateur',
        'mot_de_passe',
        'telephone_utilisateur',
        //'role_id'
    ];

    protected $table = 'utilisateurs';

    protected $guard = 'utilisateur';

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
