<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.registre');
    }

    public function registre(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' =>'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $id = DB::table('users')->insertGetId([
            'name' => $data['name'],
            'email' =>$data['email'],
            'password' => Hash::make($data['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Auth::loginUsingId($id);
        $request->session()->regenerate();

        return redirect()->route('post.index')->with('exito', 'Cuenta creada. ¡Bienvenido!');
    }

    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credencials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($credencials, $request->boolean('remember'))){
            $request->session()->regenerate();

            return redirect()->intended(route('posts.index'));
        }

        return back()->withInput($request->only('email'))->with('error', 'Correo o contraseña incorrectos.');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('posts.index');
    }
}
