<?php

namespace Database\Seeders;

use App\Models\EquipoNFL;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EquipoNFLSeeder extends Seeder
{
    public function run()
    {
        // Hacer la solicitud a la API
        $response = Http::get('https://api.sportsdata.io/v3/nfl/scores/json/TeamsBasic?key=5da8167888bc4e42b3c9735c1af83c63');

        if ($response->successful()) {
            $equiposNFL = $response->json();

            foreach ($equiposNFL as $equipoNFL) {
                EquipoNFL::updateOrCreate(
                    ['id' => $equipoNFL['TeamID']], // Usa 'TeamID' como clave primaria
                    [
                        'ciudad' => $equipoNFL['City'],
                        'nombre' => $equipoNFL['Name'],
                        'nombre_completo' => $equipoNFL['FullName'],
                        'conferencia' => $equipoNFL['Conference'],
                    ]
                );
            }
            Log::info('Equipos importados correctamente.');
        } else {
            Log::error('Error al obtener los datos de la API.');
        }
    }
}
