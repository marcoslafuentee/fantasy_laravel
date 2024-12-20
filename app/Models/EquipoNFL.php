<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class EquipoNFL extends Model
{
    use HasFactory;

    protected $table = 'equipos_nfl'; // Usa 'equipos_nfl' como nombre de tabla

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'unsignedBigInteger'; // Ajusta el tipo de la clave primaria

    protected $fillable = ['id', 'ciudad', 'nombre', 'nombre_completo', 'conferencia'];

    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }
}
