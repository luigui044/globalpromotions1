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
use App\Models\VwVentasPorLocalidadYFecha;
use DB;

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

        // Si el usuario especifica un rango de fechas se cambia la consulta
        if ($request->fechas_reporte != '') {
            $fechas = explode(';', $request->fechas_reporte);
            $fechaInicial = $fechas[0];
            $fechaFinal = $fechas[1];

            $ventas = VwVentasPorLocalidadYFecha::select(
                'localidad',
                DB::raw('SUM(cantidad) as cantidad'),
                'precio',
                DB::raw('SUM(total) as total')
            )
            ->whereBetween(
                'fecha_creacion', 
                [
                    $fechaInicial ,
                    $fechaFinal
                ]
            )
            ->groupby('id_localidad')
            ->orderby('total', 'desc')
            ->get();
        } else {
            $ventas = VwVentasPorLocalidad::where('id_evento', $request->id_evento)
                ->orderby('total', 'desc')
                ->get();
        }

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
