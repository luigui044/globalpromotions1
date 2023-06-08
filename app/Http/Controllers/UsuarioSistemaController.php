<?php

namespace App\Http\Controllers;

use App\Models\CEstadoUsuario;
use App\Models\CRolesUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
use Illuminate\Support\Facades\Hash;

class UsuarioSistemaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::paginate(10);
        return view('administracion.mantenimientos.usuarios.inicio', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = CRolesUsuario::all();
        $estados = CEstadoUsuario::all();
        return view('administracion.mantenimientos.usuarios.crear', compact('roles', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|min:2',
            'middle_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'segundo_apellido' => 'required|string|min:2',
            'telefono' => 'required|regex:/^[0-9]{8}$/',
            'email' => 'required|email',
            'rol' => 'required',
            'estado' => 'required',
            'password' => 'required'
        ]);

        try {
            $usuario = new User();
            $usuario->first_name = $request->first_name;
            $usuario->middle_name = $request->middle_name;
            $usuario->last_name = $request->last_name;
            $usuario->segundo_apellido = $request->segundo_apellido;
            $usuario->name = "$usuario->first_name $usuario->middle_name $usuario->last_name $usuario->segundo_apellido";
            $usuario->telefono = $request->telefono;
            $usuario->email = $request->email;
            $usuario->rol = $request->rol;
            $usuario->estado = $request->estado;
            $usuario->password =  Hash::make($request->password);
            $usuario->save();
            Alert::success('Información', 'Usuario creado exitosamente');
        } catch (Exception $e) {
            Alert::error('Error', 'Ocurrió un error al intentar crear al usuario');
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        if ($usuario !== null) {
            $roles = CRolesUsuario::all();
            $estados = CEstadoUsuario::all();
            return view('administracion.mantenimientos.usuarios.editar', compact('usuario', 'roles', 'estados'));
        }
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
        $request->validate([
            'first_name' => 'required|string|min:2',
            'middle_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'segundo_apellido' => 'required|string|min:2',
            'telefono' => 'required|regex:/^[0-9]{8}$/',
            'email' => 'required|email',
            'rol' => 'required',
            'estado' => 'required'
        ]);

        $usuario = User::find($id);
        if ($usuario !== null) {
            try {
                $usuario->first_name = $request->first_name;
                $usuario->middle_name = $request->middle_name;
                $usuario->last_name = $request->last_name;
                $usuario->segundo_apellido = $request->segundo_apellido;
                $usuario->name = "$usuario->first_name $usuario->middle_name $usuario->last_name $usuario->segundo_apellido";
                $usuario->telefono = $request->telefono;
                $usuario->email = $request->email;
                $usuario->rol = $request->rol;
                $usuario->estado = $request->estado;
                $usuario->save();
                Alert::success('Información', 'Perfil actualizado exitosamente');
            } catch (Exception $e) {
                Alert::error('Error', 'No se pudo actualizar la información del usuario');
            }
            return back();
        }
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
            User::destroy($id);
            Alert::success('Información', 'Usuario eliminado exitosamente');
        } catch (Exception $e) {
            Alert::error('Error', 'No se pudo eliminar el usuario');
        }
        return back();
    }

    function actualizarPassword(Request $request, $id) {
        $request->validate([
            'contrasena_nueva' => 'required',
            'confirmar_contrasena' => 'required'
        ]);

        if ($request->contrasena_nueva == $request->confirmar_contrasena) {
            $usuario = User::find($id);
            if ($usuario !== null) {
                $usuario->password = Hash::make($request->contrasena_nueva);
                $usuario->save();
                Alert::success('Información', 'Contraseña actualizada exitosamente');
            } else {
                Alert::error('Error', 'No se encontró el registro de usuario');
            }
        } else {
            Alert::error('Error', 'Las contraseñas ingresadas no coinciden');
        }

        return back();
    }
}
