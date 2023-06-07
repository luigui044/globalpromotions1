<?php

namespace App\Http\Controllers;

use App\Models\TEvento;
use App\Models\TVenta;
use App\Models\VwClientesCompra;
use App\Models\VwVentasPorLocalidad;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VwDetalleVentaCliente;
use App\Models\VwVentasCliente;

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

    function clientes() {
        $clientes = VwClientesCompra::orderby('nombre')->get();
        return view('administracion.reportes.clientes', compact('clientes'));
    }

    function detallesCliente($id) {
        $cliente = User::find($id);

        $ventas = VwVentasCliente::where('id_cliente', $id)->orderby('fecha', 'desc')->paginate(10);

        if ($cliente !== null) {
            return view('administracion.reportes.cliente', compact('cliente', 'ventas'));
        }
    }

    function detallesVentaCliente($idCliente, $idVenta) {
        $detalle = VwDetalleVentaCliente::where('id_venta', $idVenta)
            ->orderby('fecha_creacion')
            ->get();

        return view('administracion.reportes.venta-cliente', compact('detalle', 'idCliente'));
    }
}
