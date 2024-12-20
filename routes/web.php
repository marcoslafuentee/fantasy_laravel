<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
|
| Aquí se definen las rutas de autenticación proporcionadas por Laravel.
|
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Rutas Generales
|--------------------------------------------------------------------------
|
| Ruta para la página de inicio (Welcome)
|
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Ruta para "Dashboard"
Route::get('/dashboard', [LigaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas por Autenticación
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Rutas para el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ruta para "Equipo"
    Route::get('/equipo', [EquipoController::class, 'index'])->name('equipo');

    Route::get('/equipo/create', [EquipoController::class, 'create'])->name('equipo.create');
    Route::post('/equipo', [EquipoController::class, 'store'])->name('equipo.store');


    // Ruta para "Jugadores"
    Route::get('/jugadores', [JugadorController::class, 'index'])->name('jugadores');
});

/*
|--------------------------------------------------------------------------
| Rutas para la gestión de ligas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/ligas/create', [LigaController::class, 'create'])->name('ligas.create');
    Route::post('/ligas', [LigaController::class, 'store'])->name('ligas.store');
    Route::get('/ligas/join', [LigaController::class, 'join'])->name('ligas.join');
    Route::post('/ligas/join/{liga}', [LigaController::class, 'joinLeague'])->name('ligas.joinLeague');
    Route::get('/ligas/{liga}/clasificacion', [LigaController::class, 'clasificacion'])->name('ligas.clasificacion');
});

/*
|--------------------------------------------------------------------------
| Rutas de Usuarios (Admin, por ejemplo)
|--------------------------------------------------------------------------
*/
Route::resource('users', UserController::class);
