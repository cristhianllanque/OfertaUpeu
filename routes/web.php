<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PostulacionController;

// Ruta de la página de inicio (home)
Route::get('/', function () {
    return view('welcome'); // Asegúrate de tener una vista llamada 'welcome'
})->name('home');

// Ruta de inicio de sesión con método POST para manejar el formulario
Route::post('login', [LoginController::class, 'login'])->name('login.post');

Route::get('/waiting-for-approval', function () {
    return view('auth.waiting_for_approval');
})->name('approval.wait');

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

// Rutas para ofertas laborales
Route::resource('ofertas', OfertaController::class);
Route::post('ofertas/{id}/postularse', [OfertaController::class, 'postularse'])->name('postularse');
Route::get('mis-postulaciones', [OfertaController::class, 'misPostulaciones'])->name('mis-postulaciones');
Route::get('gestionar-postulaciones', [OfertaController::class, 'gestionarPostulaciones'])->name('gestionar-postulaciones');
Route::patch('postulaciones/{id}/actualizar-estado', [OfertaController::class, 'actualizarEstado'])->name('postulaciones.actualizar-estado');

// Nueva ruta para ver los detalles del postulante
Route::get('postulantes/{id}', [OfertaController::class, 'verPostulante'])->name('postulantes.ver');

// Nuevas rutas para el controlador de Postulaciones
Route::delete('/postulaciones/{id}/cancelar', [PostulacionController::class, 'cancelarPostulacion'])->name('postulaciones.cancelar');
Route::get('/postulaciones', [PostulacionController::class, 'index'])->name('postulaciones.index');

Route::delete('/postulaciones/{id}/cancelar', [PostulacionController::class, 'cancelarPostulacion'])->name('postulaciones.cancelar');
Route::get('/postulaciones', [PostulacionController::class, 'index'])->name('postulaciones.index');


// Fin de las rutas
