<?php

namespace App\Http\Controllers;

use App\Models\TEvento;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    function ventas() {
        $eventos = TEvento::all();
        return view('administracion.reportes.ventas', compact('eventos'));
    }
}
