<?php

namespace Database\Seeders;

use App\Models\Jugador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JugadoresSeeder extends Seeder
{



    public function run()
    {
        // Hacer la solicitud a la API
        $response = Http::get('https://api.sportsdata.io/v3/nfl/scores/json/PlayersByAvailable?key=5da8167888bc4e42b3c9735c1af83c63');

        if ($response->successful()) {
            $jugadores = $response->json();

            foreach ($jugadores as $jugador) {
                // Filtrar solo los jugadores con status "Active"
                if ($jugador['Status'] === 'Active') {
                    Jugador::updateOrCreate(
                        ['nombre' => $jugador['FirstName'], 'apellido' => $jugador['LastName']],
                        [
                            'equipo_nfl_id' => $jugador['TeamID'],
                            'posicion' => $jugador['Position'], // Guardar la posición como string
                            'puntos_fantasy' => 0 // Este valor puede ser modificado según sea necesario
                        ]
                    );
                }
            }

            Log::info('Jugadores activos importados correctamente.');
        } else {
            Log::error('Error al obtener los datos de la API.');
        }
    }


}
