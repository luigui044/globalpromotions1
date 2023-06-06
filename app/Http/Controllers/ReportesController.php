<?php

namespace App\Http\Controllers;

use App\Models\TEvento;
use App\Models\VwVentasPorLocalidad;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function ventas() {
        $eventos = TEvento::all();
        return view('administracion.reportes.ventas', compact('eventos'));
    }

    function ventasPorLocalidad(Request $request) {
        $request->validate([
            'id_evento' => 'required'
        ]);

        $ventas = VwVentasPorLocalidad::where('id_evento', $request->id_evento)
            ->orderby('total', 'desc')
            ->get();
        return view('administracion.reportes.partials.ventas-localidad', compact('ventas'));
    }
}
