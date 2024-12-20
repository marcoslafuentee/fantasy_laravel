<?php

namespace App\Http\Controllers;

use App\Models\Liga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LigaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $ligas = $user->ligas; // Obtener las ligas en las que está el usuario

        return view('dashboard', compact('ligas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ligas.create'); // Asegúrate de que esta vista exista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'max_users' => 'required|integer|min:2',
        ]);

        Liga::create([
            'nombre' => $request->nombre,
            'max_users' => $request->max_users,
        ]);

        return redirect()->route('dashboard')->with('success', 'Liga creada exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function join()
    {
        $ligas = Liga::whereDoesntHave('users', function ($query) {
            $query->where('user_id', Auth::id());
        })->get(); // Obtener ligas a las que el usuario no está unido

        return view('ligas.join', compact('ligas')); // Asegúrate de que esta vista exista
    }

    /**
     * Join a league.
     */
    public function joinLeague(Liga $liga)
    {
        if ($liga->isFull()) {
            return redirect()->route('ligas.join')->with('error', 'La liga ya está llena.');
        }

        $user = Auth::user();
        $user->ligas()->attach($liga->id); // Unir al usuario a la liga


        // Redirigir a la vista de clasificación de la liga a la que se unió
        return redirect()->route('ligas.clasificacion', $liga->id)->with('success', 'Te has unido a la liga exitosamente.');


    }






    public function clasificacion(Liga $liga)
    {

        // Almacenar el `liga_id` en la sesión
        session(['liga_id' => $liga->id]);

        // Obtener los usuarios asociados a la liga
        $users = $liga->users;

        // Retornar la vista de clasificación desde la carpeta 'usuarios'
        return view('usuarios.clasificacion', compact('liga', 'users'));

    }


    public function ligas()
    {
        return $this->belongsToMany(Liga::class, 'liga_user', 'user_id', 'liga_id');
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
