<?php

namespace App\Http\Controllers;
use Jenssegers\Date\Date;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;
use App\Models\TPrueba;
use App\Models\TEvento;
use App\Models\VwAsiLocalidade;
use App\Models\TBoleto;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Generator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Exception;
use JavaScript;

class VentaController extends Controller
{
    function concierto($id){
        $evento = TEvento::where('id_evento', $id)->first();
        $localidades = VwAsiLocalidade::where('evento',$id)->get();
        $fecha= new Date( Carbon::create($evento->fechas)->toDayDateTimeString());
        $fecha2= $fecha->format('j F Y');
        $dia = $fecha->format('l');
        JavaScript::put([
            'evento' => $evento,
            'localidades' => $localidades,
        ]);
        return view('tiquetera.venta-concierto',compact('evento','localidades','fecha2','dia'));

    }

    function vender(Request $req){

        $prevReq = $req->session()->get('request');

        $evento = TEvento::find($prevReq->id);
        $fecha= new Date( Carbon::create($prevReq->fechas)->toDayDateTimeString());
        $fecha2= $fecha->format('j F Y');
        $dia = $fecha->format('l');
        $cantidad = $prevReq->cantidad;
        $boletos = array();



        for ($i=0; $i < $cantidad ; $i++) { 
            $nuevoBoleto = new TBoleto();
            $nuevoBoleto->id_localidad = $prevReq->localidad;
            $nuevoBoleto->id_evento = $prevReq->evento;
            $nuevoBoleto->fecha_stamp = strtotime('now');
            $nuevoBoleto->save();

            $boleto = $nuevoBoleto->id;
            $localidad = $nuevoBoleto->id_localidad ;
            $evento1 =  $nuevoBoleto->evento; 
            $fechaStamp =$nuevoBoleto->fecha_stamp;
        //codigo para genera el qr 
            $qrCode =new Generator;
            $rutaImagen = storage_path('globalProd/public/img/logo.jpg');
            $nuevoBoleto->codigo_qr = QrCode::size(170)->style('dot')->eye('circle')->merge('\public\img\logo.png',.5)->generate($boleto.'-'.$localidad.'-'.$evento1.'-'.$fechaStamp);
            $nuevoBoleto->save();
        // $pruebaQR= $qrCode->size(500)->generate('6218447047');
        // $boleto->qr = $pruebaQR;
        array_push($boletos,$nuevoBoleto);
        }
        return view('tiquetera.ticket', compact('boletos','evento','fecha2','dia'));
    }

    function obtenerDetalleUbicacion($ubicacion) {
        $partes = explode('-', $ubicacion);
        $mesa = str_replace('mesa', '', $partes[0]);
        $asiento = str_replace('asiento', '', $partes[1]); 
        return ['mesa' => $mesa, 'asiento' => $asiento];
    }

    function ubicacionDisponible(Request $request) {
        $ubicacion = $request->ubicacion;
        $partes = $this->obtenerDetalleUbicacion($ubicacion);
        $mesa = $partes['mesa'];
        $asiento = $partes['asiento'];

        $resultado = TmpDetallesVenta::where('mesa', $mesa)
            ->where('asiento', $asiento)
            ->first();

        if (is_null($resultado))
            return response()->json(['estado' => true]);
        return response()->json(['estado' => false]);
    }

    function listarUbicacionesVendidas($idEvento, $idLocalidad) {
        $ubicaciones = TBoleto::where('id_evento', $idEvento)->where('id_localidad', $idLocalidad)->get();
        return $ubicaciones;
    }

    function filtrarDisLocalidad(Request $req){
        $localDis = VwAsiLocalidade::where('id_asignacion',$req->id)->first();
        return view('tiquetera.partials.localidad-disponible',compact('localDis'));
    }

    function desplegarMesas(){
        return view('desplegarmesas');
    }

    function desplegarsillas(){
        return view('desplegarsillas');
    }

    function selectAsientos(Request $req){
        $asignacion = VwAsiLocalidade::where('id_asignacion', $req->id)->first();
        $tipoLocal = $asignacion->tipo_localidad;     
        $cantidad = $asignacion->cantidad;

        JavaScript::put([
            'tipoLocalidad' => $tipoLocal,
        ]);

        switch ($tipoLocal) {
            case 'Mesa':
                return view('tiquetera.desplegarmesas', compact('cantidad', 'asignacion'));
            break;
            case 'Silla':
                return view('tiquetera.desplegarsillas', compact('cantidad', 'asignacion'));
            break;
            default:
                return view('tiquetera.partials.default');
            break;
        }

    }

}
