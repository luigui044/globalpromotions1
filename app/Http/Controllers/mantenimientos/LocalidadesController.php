<?php

namespace App\Http\Controllers\mantenimientos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CTipoLocalidad;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class LocalidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localidades = CTipoLocalidad::paginate(10);
        return view('administracion.mantenimientos.localidades.inicio', compact('localidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['localidad' => 'required']);

        try {
            $localidad = new CTipoLocalidad();
            $localidad->des_tipo = $request->localidad;
            $localidad->save();
            Alert::success('Información', 'Localidad agregada con éxito');
        } catch (Exception $e) {
            Alert::error('Error', 'No se pudo agregar la localidad');
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['localidad' => 'required']);
        try {
            $localidad = CTipoLocalidad::find($id);
            if ($localidad !== null) {
                $localidad->des_tipo = $request->localidad;
                $localidad->save();
                Alert::success('Información', 'Localidad actualizada con éxito');
            } else {
                Alert::error('Error', 'No se encontró el registro de localidad a actualizar');
            }
        } catch (Exception $e) {
            Alert::error('Error', 'No se pudo actualizar la información de la localidad');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            CTipoLocalidad::destroy($id);
            Alert::success('Información', 'Localidad eliminada con éxito');
        } catch(Exception $e) {
            Alert::error('Error', 'No es posible eliminar esta localidad ya que se encuentra relacionada con eventos registrados.');
        } finally {
            return back();
        }
    }
}
