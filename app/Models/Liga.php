<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'max_users']; // Campos que se pueden llenar masivamente

    public function users()
    {
        return $this->belongsToMany(User::class, 'liga_user', 'liga_id', 'user_id');
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'liga_id');
    }

    // Verificar si la liga ha alcanzado el límite de usuarios
    public function isFull()
    {
        return $this->users()->count() >= $this->max_users;
    }

}
