<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $table = 'jugadores';

    protected $fillable = ['nombre', 'apellido', 'equipo_nfl_id', 'equipo_id', 'posicion', 'puntos_fantasy'];

    public function equipoNFL()
    {
        return $this->belongsTo(EquipoNFL::class, 'equipo_nfl_id');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }


}
