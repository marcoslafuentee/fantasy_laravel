<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos'; // Esto debe apuntar a la tabla 'equipos'

    protected $fillable = ['nombre', 'liga_id', 'user_id'];

    public function liga()
    {
        return $this->belongsTo(Liga::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }

}
