<?php

namespace App\Http\Controllers;
use App\Models\TGaleria;
use App\Models\Usuario;
use App\Models\TEvento;

use Illuminate\Http\Request;

use DB;

class HomeController extends Controller
{
    function home(){
        $eventos  = TEvento::where('estado_evento',2)->get();
        return view('home.welcome',compact('eventos'));
    }

    function galeria(){

        return view('home.galery');
    }

    function subGalery($idArtista){
        $galeria = TGaleria::select('id_galeria', 'link_previo', 'link_download')->where('id_artista', $idArtista)->paginate(9);
        return view('home.partials.sub-galery', compact('galeria'));
    }
    
    function guardarUsuario(Request $request) {
        $request->validate([
            'nombre' => 'required|string|min:2',
            'email' => 'required|email',
        ]);
        
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->ip = $request->ip();
        $usuario->telefono = $request->telefono;
        $usuario->save();
        
        return back()->with('mensaje', 'Ahora puede descargar libremente cualquiera de las fotos de la galería. Muchas gracias.');
    }
    
    function existeIpCliente($ip) {
        $sql = Usuario::select(DB::raw('COUNT(*) as resultado'))->where('ip', $ip)->first();    
        if ($sql->resultado > 0)
            return response()->json(['existe' => true]);
        return response()->json(['existe' => false]);
    }
}
