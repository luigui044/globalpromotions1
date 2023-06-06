<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\AsientosController;
use App\Http\Controllers\PreRreservaController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\TicketsController;
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
Route::get('/concierto/{id?}',[VentaController::class, 'concierto'])->middleware(['auth'])->name('concierto');
Route::post('/ticketComprado/{id}', [VentaController::class, 'vender'])->name('vender');
Route::post('/entradas/disponibilidad', [VentaController::class, 'ubicacionDisponible'])->name('ubicacion-disponible');
Route::get('/tickets/vendidos/{idEvento}/{idLocalidad}', [PreRreservaController::class, 'listarUbicacionesVendidas'])->name('ubicaciones-vendidas');
Route::get('/tickets/prerreservados/{idEvento}/{idLocalidad}', [PreRreservaController::class, 'listarUbicacionesPrerreservadas'])->name('ubicaciones-prerreservadas');
Route::post('/tickets/prerreserva', [PreRreservaController::class, 'dispatchPreReserva'])->name('prerreserva');
Route::post('/tickets/guardar-prerreserva', [PreRreservaController::class, 'guardarPrerreserva'])->name('prerreserva.guardar');
Route::post('/tickets/liberar-prerreserva', [PreRreservaController::class, 'liberarPrerreserva'])->name('prerreserva.liberar');
Route::post('/tickets/eliminar-prerreserva', [PreRreservaController::class, 'eliminarPrerreserva'])->name('prerreserva.eliminar');
Route::post('/filDisLocalidad', [VentaController::class, 'filtrarDisLocalidad'])->name('filtrarDisLocalidad');

Route::post('/selectAsientos', [AsientosController::class, 'selectAsientos'])->name('selectAsientos');

Route::post('/paypal/checkout', [PayPalController::class, 'checkout'])->name('paypal.checkout');
Route::get('/paypal/complete', [PayPalController::class, 'complete'])->name('paypal.complete');
Route::post('/process-payment', [PayPalController::class, 'processPayment'])->name('process-payment');
Route::get('/proof/{mesa}/{asiento}', [VentaController::class, 'proof']);
Route::view('/ws', 'ws');

route::post('/tiquetera/sendPDF',[VentaController::class, 'sendPdfEmail'] )->name('sendPdfEmail');

route::get('/pruebaPDF',[TicketsController::class, 'pruebaPDF'] )->name('pruebaPDF');
route::get('/pruebaView',[TicketsController::class, 'pruebaView'] )->name('pruebaView');

// Rutas para usuarios
Route::get('/usuario/perfil', [UsuarioController::class, 'perfil'])->name('perfil');
Route::get('/usuario/perfil/editar', [UsuarioController::class, 'editarPerfil'])->name('perfil.editar');
Route::post('/usuario/perfil/editar', [UsuarioController::class, 'actualizarPerfil'])->name('perfil.actualizar');
Route::post('/usuario/perfil/actualizar-contrasena', [UsuarioController::class, 'actualizarContrasena'])->name('perfil.contrasena.actualizar');

// Rutas para reportes
Route::get('/administracion/reportes/ventas', [ReportesController::class, 'ventas'])->name('reporte.ventas');
Route::post('/administracion/reportes/ventas-por-localidad', [ReportesController::class, 'ventasPorLocalidad'])->name('reporte.ventas.localidad');

require __DIR__.'/auth.php';
