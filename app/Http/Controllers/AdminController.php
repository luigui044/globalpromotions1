<?php

namespace App\Http\Controllers;
use App\Models\Artista;
use App\Models\TEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TAsigLocalidade;
use App\Models\VwAsiLocalidade;
use App\Models\TLocalidade;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    // funcion que retorna vista para crear nuevo evento
    function nuevoEvento(){
        $artistas = Artista::all();
        $evento = 'active';
        $nEvento= 'active';
        $titulo = 'Agregar Nuevo Evento';
        return view('administracion.nuevo-evento', compact('artistas','evento','nEvento','titulo'));
    }
    // se crea el evento a registrar 
    function crearEvento(Request $req){
        $req->validate([
            'nombreEvento' => 'required|string|min:2',
            'fecha' => 'required',
            'hora' => 'required',
            'artista' => 'required',
            'lugar' => 'required',
            'copy' => 'required'
        ]);

        $porta = $req->file('fotoPortada')->store('public/eventos');
        $urlPorta = Storage::url($porta);
        $banner = $req->file('fotoBanner')->store('public/eventos'); 
        $urlBanner = Storage::url($banner);
        $lugar = $req->file('fotoLugar')->store('public/eventos'); 
        $urlLugar = Storage::url($lugar);

        $nEvento = new TEvento();
        $nEvento->titulo_evento = $req->nombreEvento;
        $nEvento->copy_evento = $req->copy;
        $nEvento->id_artista = $req->artista;
        $nEvento->fechas = $req->fecha;
        $nEvento->hora = $req->hora;
        $nEvento->image_card = $urlPorta;
        $nEvento->image_banner = $urlBanner;
        $nEvento->imagen_lugar = $urlLugar;
        $nEvento->estado_evento = 1;
        $nEvento->lugar = $req->lugar;
        $nEvento->save();
        Alert::success('Información', "El evento <b>$nEvento->titulo_evento</b> ha sido agregado exitosamente.");
        return back();
    }

     // muestra la lista de eventos registrados
    function eventos(){
        $listaEventos = TEvento::all();
        $evento = 'active';
        $eventos= 'active';
        return view('administracion.eventos', compact('evento','eventos','listaEventos'));
    }
    // funcion retorna vista para editar un evento 
    function editarEvento(Request $req){
        $artistas = Artista::all();
        $detEvento = TEvento::where('id_evento',$req->id)->first();

        $evento = 'active';
        $eventos= 'active';
        $titulo = 'Editar Evento';
        return view('administracion.editar-evento', compact('artistas','evento','eventos','detEvento','titulo'));
    }
    // actualiza cambios en un evento
    function actEvento(Request $req){

        $evento  = TEvento::find($req->id);
        $evento->titulo_evento = $req->nombreEvento;
        $evento->copy_evento = $req->copy;
        $evento->id_artista = $req->artista;
        if($req->fecha !=null)
        {
            $evento->fechas = $req->fecha_submit;
        }
        $evento->hora = $req->hora;
        if($req->file('fotoPortada')!=null)
       {
        $porta = $req->file('fotoPortada')->store('public/eventos');
        $urlPorta = Storage::url($porta);
        $evento->image_card = $urlPorta;
        }
        if($req->file('fotoBanner') !=null){
        $banner = $req->file('fotoBanner')->store('public/eventos');     
        $urlBanner = Storage::url($banner);
        $evento->image_banner = $urlBanner;
        }

        if($req->file('fotoLugar') != null){
        $lugar = $req->file('fotoLugar')->store('public/eventos');     
        $urlLugar = Storage::url($lugar);
        $evento->imagen_lugar = $urlLugar;
        }
        $evento->estado_evento = 1;
        $evento->lugar = $req->lugar;
        $evento->save();
        return redirect('/eventos')->with('status','Evento Actualizado Correctamente');

    }
    // nos da un partial con la consulta de los detalles del eevento
    function detaEvento(Request $req){
        $evento  = TEvento::where('id_evento',$req->id)->first();
        $localidades = VwAsiLocalidade::where('evento',$req->id)->get();
        $artista = Artista::where('id_artista',$evento->id_artista)->first();
        return view('administracion.partials.det-evento',compact('evento','localidades','artista'));
    }
    // desactiva un evento
    function desEvento(Request $req)
    {
        $evento = TEvento::where('id_evento',$req->id)->first();
        $evento->estado_evento = 3;
        $evento->save();
    }

    // asignacion de localidades vista
    function setLocalidad($id)
    {
        $localidades  = TLocalidade::all();
        $eventoSet =TEvento::find($id);
        $localEvento = VwAsiLocalidade::where('evento',$id)->orderBy('precio','desc')->get();
        return view('administracion.setLocalidad', compact('eventoSet','localEvento','localidades'));
    }
    //////////////////funciones para localidades//////////////////

    function listLocal(Request $req)
    {
        $localEvento = VwAsiLocalidade::where('evento',$req->id)->orderBy('precio','desc')->get();
        return view('administracion.partials.asig-localidad',compact('localEvento'));

    }


    function agregarLocalidad(Request $req)
    {
        $regLocalidad = new TAsigLocalidade();
        $regLocalidad->evento = $req->id;
        $regLocalidad->localidad = $req->localidad;
        $regLocalidad->cantidad = $req->cantidad;
        $regLocalidad->precio   = $req->precio;
        $regLocalidad->estado = 1;
        $regLocalidad->save();

        // $localEvento = VwAsiLocalidade::where('evento',$req->id)->orderBy('precio')->get();
        $eventoState = TEvento::find($req->id);

        if($eventoState->estado_evento == 1 ){
            $eventoState->estado_evento = 2;
            $eventoState->save();
        }
        // return view('administracion.partials.asig-localidad',compact('localEvento'));
    }
    function removerLocalidad(Request $req)
    {
        $deleteLocal = TAsigLocalidade::find($req->id);
        $deleteLocal->delete();
        $localCant = TAsigLocalidade::where('evento',$req->idEvento)->first();

        if( $localCant ==null )
        {
            $eventoState = TEvento::find($req->idEvento);
            $eventoState->estado_evento = 1;
            $eventoState->save();
        }
        
    
  
    }
    function editarLocalidad(Request $req)
    {
        $updateLocal = TAsigLocalidade::find($req->id);
        if($req->nPrecio != 0 && $req->nPrecio != null )
        {
            $updateLocal->precio = $req->nPrecio;

        }
        if($req->nCantidad != 0 && $req->nCantidad != null)
       {
        $updateLocal->cantidad = $req->nCantidad;
       }
        $updateLocal->save();
        return 'Localidad Actualizada corectamente';
    }


    function agregarDescuento(Request $req){
        $fecha1 =  date('Y/m/d', strtotime( $req->inicio));
        $fecha2 =  date('Y/m/d', strtotime( $req->final));
        $desLocal =  TAsigLocalidade::find($req->id);
        $desLocal->descuento = $req->descuento;
        $desLocal->inicio_desc= $fecha1 ;
        $desLocal->fin_desc = $fecha2 ;
        $desLocal->save();
        return 'Descuento agregado éxitosamente';

    }
}
