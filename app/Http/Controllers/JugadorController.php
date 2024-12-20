<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JugadorController extends Controller
{
    public function index()
    {
        // Obtener los jugadores desde la API
        $response = Http::get('https://api.sportsdata.io/v3/nfl/scores/json/PlayersByAvailable?key=5da8167888bc4e42b3c9735c1af83c63');
        $players = $response->json();

        // Guardar los jugadores en la base de datos
        foreach ($players as $player) {
            Jugador::updateOrCreate(
                ['id' => $player['PlayerID']], // Asume que 'PlayerID' es un campo único
                [
                    'nombre' => $player['FirstName'],
                    'apellido' => $player['LastName'],
                    'equipo_nfl_id' => $player['TeamID'] ?? null, // Usa TeamID si está disponible
                    'posicion' => $player['Position'],
                    'puntos_fantasy' => 0, // No se proporciona en esta respuesta, se puede agregar en otra solicitud
                ]
            );
        }

        // Obtener todos los jugadores para mostrarlos en la vista
        //$jugadores = Jugador::all();

        // Obtener todos los jugadores para mostrarlos en la vista, paginados
        $jugadores = Jugador::with('equipoNFL')->paginate(25);

        return view('jugadores', ['jugadores' => $jugadores]); //CAMBIO ESTO PRECAUCIÓN  return view('players.index', ['jugadores' => $jugadores]);
    }
}
