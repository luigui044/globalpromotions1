<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;

class TrackingController extends Controller
{
    public function clicEvento(Request $request) {
        $tracking = new Tracking();
        $tracking->ip = $request->ip;
        $tracking->fecha_hora = $request->fecha_hora;
        $tracking->clic = 1;
        $tracking->id_evento =$request->id_evento;
        $tracking->save();
        
        return response()->json(['mensaje' => 'Registro almacenado']);
    }
}
