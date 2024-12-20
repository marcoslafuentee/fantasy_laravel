<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        // Obtener todos los users de la base de datos
        $users = User::all();

        // Pasar los users a la vista de clasificación
        return view('usuarios.clasificacion')->with('users', $users);
    }
}
