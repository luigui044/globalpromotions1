<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class, 'home'] )->name('home');
Route::get('/nuevo-evento',[AdminController::class, 'nuevoEvento'] )->name('nuevoEvento');
Route::post('/nuevo-evento',[AdminController::class, 'crearEvento'] )->name('crearEvento');
Route::get('/eventos',[AdminController::class, 'eventos'] )->name('eventos');
Route::post('/detEvento',[AdminController::class, 'detaEvento'])->name('detEvento');
Route::post('/desEvento',[AdminController::class, 'desEvento'])->name('desEvento');
Route::get('/editEvento',[AdminController::class, 'editarEvento'])->name('editEvento');
Route::put('/editEvento/{id}',[AdminController::class, 'actEvento'])->name('actEvento');
Route::get('/setLocalidad/{id}',[AdminController::class, 'setLocalidad'] )->name('setLocalidad');
Route::post('/agregarLocalidad',[AdminController::class, 'agregarLocalidad'] )->name('agregarLocalidad');
Route::post('/removerLocalidad',[AdminController::class, 'removerLocalidad'] )->name('removerLocalidad');
Route::post('/desLocalidad',[AdminController::class, 'agregarDescuento'] )->name('desLocalidad');
Route::post('/updateLocal',[AdminController::class, 'editarLocalidad'] )->name('updateLocal');
Route::post('/listLocal',[AdminController::class, 'listLocal'] )->name('listLocal');







Route::get('/galery',[HomeController::class, 'galeria'])->name('galeria');
Route::get('/galery/{idArtista}',[HomeController::class, 'subGalery'])->name('subgaleria');
Route::post('/galery/guardar-datos', [HomeController::class, 'guardarUsuario'])->name('usuario.guardar');
Route::get('/existe-ip/{ip}', [HomeController::class, 'existeIpCliente']);
Route::post('/clic-evento', [TrackingController::class, 'clicEvento'])->name('clic-evento');



Route::get('/sillas', [VentaController::class, 'desplegarsillas'])->name('sillas');
Route::get('/mesas', [VentaController::class, 'desplegarMesas'])->name('mesas');
Route::get('/concierto/{id?}',[VentaController::class, 'concierto'])->name('concierto');
Route::post('/comprar', [VentaController::class, 'vender'])->name('vender');
Route::post('/entradas/reserva-temporal', [VentaController::class, 'reservaTemporalEntradas'])->name('reserva-tmp');
Route::post('/entradas/eliminar-reserva-temporal', [VentaController::class, 'eliminarReservaTemporal'])->name('eliminar-reserva-tmp');
Route::post('/entradas/disponibilidad', [VentaController::class, 'ubicacionDisponible'])->name('ubicacion-disponible');
Route::get('/entradas/reserva/{idEvento}', [VentaController::class, 'listarUbicacionesUsadas'])->name('ubicaciones-reservadas');
Route::post('/filDisLocalidad', [VentaController::class, 'filtrarDisLocalidad'])->name('filtrarDisLocalidad');

Route::get('/prueba', [VentaController::class, 'prueba']);