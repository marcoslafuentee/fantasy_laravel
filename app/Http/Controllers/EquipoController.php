<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
    public function index()
    {
        // Obtener el equipo del usuario autenticado
        $equipo = Equipo::where('user_id', Auth::id())->with('jugadores.equipo')->first();

        // Si no hay equipo, devolvemos una variable indicando que el usuario no tiene equipo
        if (!$equipo) {
            return view('equipo', [
                'equipo' => null // En lugar de redirigir, enviamos null como equipo
            ]);
        }

        // Obtener los jugadores del equipo del usuario
        $jugadores = $equipo->jugadores;

        // Organizar los jugadores en posiciones
        $posiciones = [
            'QB' => $jugadores->where('posicion', 'QB')->first(),
            'RB1' => $jugadores->where('posicion', 'RB')->skip(0)->first(),
            'RB2' => $jugadores->where('posicion', 'RB')->skip(1)->first(),
            'WR1' => $jugadores->where('posicion', 'WR')->skip(0)->first(),
            'WR2' => $jugadores->where('posicion', 'WR')->skip(1)->first(),
            'TE' => $jugadores->where('posicion', 'TE')->first(),
            'WR/RB' => $jugadores->whereIn('posicion', ['WR', 'RB'])->skip(2)->first(),
            'K' => $jugadores->where('posicion', 'K')->first(),
            'DEF' => $jugadores->where('posicion', 'DEF')->first(),
        ];

        // Obtener los jugadores en la banca (BN)
        $banca = $jugadores->whereNotIn('posicion', array_keys($posiciones))->take(4);

        // Enviar los datos a la vista
        return view('equipo', [
            'equipo' => $equipo,
            'posiciones' => $posiciones,
            'banca' => $banca,
        ]);
    }


    public function create(Request $request)
    {
        // Obtener el `liga_id` de la sesión
        $ligaId = session('liga_id');

        // Si no hay una liga seleccionada, redirigir al usuario para que elija una
        if (!$ligaId) {
            return redirect()->route('dashboard')->with('error', 'Primero debes seleccionar una liga.');
        }

        // Retornar la vista de creación del equipo con el `liga_id`
        return view('equipo.create', ['ligaId' => $ligaId]);
    }


    public function store(Request $request)
    {
        // Obtener el `liga_id` de la sesión
        $ligaId = session('liga_id');

        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crear el equipo asociado a la liga seleccionada
        Equipo::create([
            'user_id' => Auth::id(),
            'nombre' => $request->input('nombre'),
            'liga_id' => $ligaId, // Usar el `liga_id` almacenado en la sesión
        ]);

        return redirect()->route('equipo')->with('success', 'Equipo creado exitosamente.');
    }




}
