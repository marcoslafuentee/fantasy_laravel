<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EquipoNFLController extends Controller
{
    public function index()
    {
        // Obtener los jugadores desde la API
        $response = Http::get('https://api.sportsdata.io/v3/nfl/scores/json/TeamsBasic?key=5da8167888bc4e42b3c9735c1af83c63');
        $equiposNFL = $response->json();

        // Guardar los jugadores en la base de datos
        foreach ($equiposNFL as $equipoNFL) {
            Equipo::updateOrCreate(
                ['id' => $equipoNFL['TeamID']], // campo único
                [
                    'ciudad' => $equipoNFL['City'],
                    'nombre' => $equipoNFL['Name'],
                    'nombre_completo' => $equipoNFL['FullName'],
                    'conferencia' => $equipoNFL['Conference'],
                ]
            );
        }

        // Obtener todos los equipos para mostrarlos en la vista
        //$jugadores = Jugador::all();

        // Obtener todos los jugadores para mostrarlos en la vista, paginados
        //$jugadores = Jugador::paginate(50);

        return view('equiposNFL', ['equiposNFL' => $equiposNFL]); //CAMBIO ESTO PRECAUCIÓN  return view('players.index', ['jugadores' => $jugadores]);
    }
}
