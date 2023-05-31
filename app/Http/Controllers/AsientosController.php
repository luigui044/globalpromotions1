<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VwAsiLocalidade;
use JavaScript;

class AsientosController extends Controller
{
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
