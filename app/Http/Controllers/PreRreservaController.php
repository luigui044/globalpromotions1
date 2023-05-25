<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewPreReservaMesa;
use Exception;

class PreRreservaController extends Controller
{
    function mesas(Request $request) {
        $mesa = $request->mesa;
        $asiento = $request->asiento;
        try {
            // Aquí se dispara el evento cuando un usuario selecciona una ubicación del SVG del concierto
            broadcast(new NewPreReservaMesa($mesa, $asiento))->toOthers();
            return response()->json(['message' => 'Prerreserva exitosa'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Ocurrió un error inesperado'], 500);
        }
    }
}
