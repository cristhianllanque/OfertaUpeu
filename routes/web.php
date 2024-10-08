<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfertaController;

// Ruta de la página de inicio (home)
Route::get('/', function () {
    return view('welcome'); // Asegúrate de tener una vista llamada 'welcome'
})->name('home');

// Ruta de inicio de sesión con método POST para manejar el formulario
Route::post('login', [LoginController::class, 'login'])->name('login.post');



// Ruta para el dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas personalizadas para gestión de usuarios
Route::get('usuarios/pending', [UsuarioController::class, 'pending'])->name('usuarios.pending');
Route::patch('usuarios/{id}/approve', [UsuarioController::class, 'approve'])->name('usuarios.approve');

// Rutas RESTful para gestión de usuarios
Route::resource('usuarios', UsuarioController::class)->names([
    'index' => 'usuarios.index',
    'create' => 'usuarios.create',
    'store' => 'usuarios.store',
    'show' => 'usuarios.show',
    'edit' => 'usuarios.edit',
    'update' => 'usuarios.update',
    'destroy' => 'usuarios.destroy',
]);

Route::resource('ofertas', OfertaController::class);
Route::post('ofertas/{id}/postularse', [OfertaController::class, 'postularse'])->name('postularse');
Route::get('mis-postulaciones', [OfertaController::class, 'misPostulaciones'])->name('mis-postulaciones');
Route::get('gestionar-postulaciones', [OfertaController::class, 'gestionarPostulaciones'])->name('gestionar-postulaciones');
Route::patch('postulaciones/{id}/actualizar-estado', [OfertaController::class, 'actualizarEstado'])->name('postulaciones.actualizar-estado');

