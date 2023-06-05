<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function perfil() {
        return view('usuario.perfil');
    }

    function editarPerfil() {
        $usuario = Auth::user();
        return view('usuario.editar', compact('usuario'));
    }

    function actualizarPerfil(Request $request) {
        $request->validate([
            'first_name' => 'required|string|min:2',
            'middle_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'segundo_apellido' => 'required|string|min:2',
            'telefono' => 'required|regex:/^[0-9]{8}$/',
            'email' => 'required|email'
        ]);

        $usuario = User::find(Auth::user()->id);
        $usuario->middle_name = $request->middle_name;
        $usuario->segundo_apellido = $request->segundo_apellido;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->save();

        Alert::success('Información', 'Perfil actualizado exitosamente');
        return redirect()->route('perfil');
    }

    function actualizarContrasena(Request $request) {
        $request->validate([
            'contrasena_actual' => 'required|string',
            'contrasena_nueva' => 'required|string|min:8',
            'confirmar_contrasena' => 'required|string|min:8'
        ]);

        $usuario = User::find(Auth::user()->id);
        // Se verifica que la contraseña actual que ha ingresado coincida con el hash almacenado en la BDD
        if (Hash::check($request->contrasena_actual, $usuario->password)) {
            $usuario->password = Hash::make($request->contrasena_nueva);
            $usuario->save();
            Alert::success('Información', 'Contraseña actualizada exitosamente');
        } else {
            Alert::error('Error', 'La contraseña actual ingresada es incorrecta');
        }

        return back();
    }
}
