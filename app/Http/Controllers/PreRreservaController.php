<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewPreReservaMesa;
use App\Models\TBoleto;
use App\Models\TPrerreserva;
use Exception;
use Illuminate\Support\Facades\Auth;

class PreRreservaController extends Controller
{
    function listarUbicacionesVendidas($idEvento, $idLocalidad) {
        $ubicaciones = TBoleto::select('mesa', 'asiento')
            ->where('id_evento', $idEvento)
            ->where('id_localidad', $idLocalidad)
            ->get();
        return $ubicaciones;
    }

    function listarUbicacionesPrerreservadas($idEvento, $idLocalidad) {
        $ubicaciones = TPrerreserva::where('id_evento', $idEvento)->where('id_localidad', $idLocalidad)->get();
        return $ubicaciones;
    }

    function dispatchPreReserva(Request $request) {
        try {
            broadcast(new NewPreReservaMesa(
                $request->id_evento,
                $request->id_localidad,
                $request->mesa, 
                $request->asiento, 
                $request->prerreserva
            ))->toOthers();
            return response()->json(['message' => 'Prerreserva realizada exitosamente'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Ocurrió un error con la prerreserva: ' . $e->getMessage()], 500);
        } 
    }

    function guardarPrerreserva(Request $request) {
        try {
            $prerreserva = new TPrerreserva();
            $prerreserva->id_usuario = Auth::user()->id;
            $prerreserva->id_localidad = $request->id_localidad;
            $prerreserva->id_evento = $request->id_evento;
            $prerreserva->mesa = $request->mesa;
            $prerreserva->asiento = $request->asiento;
            $prerreserva->save();
            return response()->json(['message' => 'Prerreserva almacenada exitosamente'], 200);
        } catch(Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al almacenar la prerreserva: ' . $e->getMessage()], 500);
        }
    }

    function eliminarPrerreserva(Request $request) {
        $prerreserva = TPrerreserva::where('id_usuario', Auth::user()->id)
            ->where('id_evento', $request->id_evento)
            ->where('id_localidad', $request->id_localidad)
            ->where('mesa', $request->mesa)
            ->where('asiento', $request->asiento)
            ->first();
        
        if ($prerreserva !== null) {
            try {
                // Se elimina el registro
                TPrerreserva::where('id_usuario', Auth::user()->id)
                    ->where('id_evento', $request->id_evento)
                    ->where('id_localidad', $request->id_localidad)
                    ->where('mesa', $request->mesa)
                    ->where('asiento', $request->asiento)
                    ->delete();
                return response()->json(['message' => 'Prerreserva eliminada exitosamente'], 200);
            } catch (Exception $e) {
                return response()->json(['error' => 'No se pudo eliminar la prerreserva de nuestros datos: ' . $e->getMessage()], 500);
            }
        }
        return response(['message', 'No se encontró el registro de prerreserva'], 404);
    }

    function liberarPrerreserva(Request $request) {
        $ubicaciones = TPrerreserva::where('id_usuario', Auth::user()->id)
            ->where('id_localidad', $request->id_localidad)
            ->where('id_evento', $request->id_evento)
            ->get();

        if ($ubicaciones->count() > 0) {
            try {
                foreach($ubicaciones as $ubicacion) {
                    broadcast(new NewPreReservaMesa(
                        $ubicacion->id_evento,
                        $ubicacion->id_localidad,
                        $ubicacion->mesa, 
                        $ubicacion->asiento, 
                        false
                    ))->toOthers();
                }
            } catch(Exception $e) {
                return response()->json(['error' => 'Error al emitir evento de liberar asientos: ' . $e->getMessage()], 500);
            }
            
            try {
                // Se eliminan las prerreservas de la tabla
                TPrerreserva::where('id_usuario', Auth::user()->id)
                    ->where('id_localidad', $request->id_localidad)
                    ->where('id_evento', $request->id_evento)
                    ->delete();
            } catch (Exception $e) {
                return response()->json(['error' => 'Error al eliminar los asientos de nuestros datos' . $e->getMessage()], 500);
            } 
            return response()->json(['message' => 'Asientos liberados exitosamente'], 200);
        }
        return response()->json(['message' => 'No hay asientos por liberar'], 200);
    }
}
