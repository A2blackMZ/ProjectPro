<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_role',
        //'user_id',
    ];

    public function utilisateurs()
    {
        return $this->belongsToMany(Utilisateur::class, 'role_utilisateur', 'role_id', 'utilisateur_id');
    }
}
