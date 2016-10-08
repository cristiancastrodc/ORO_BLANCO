<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Session;

class UsersController extends Controller
{
    /**
     * Aplicar Middlewares
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'login']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'user' => $request['tbUser'],
            'password' => $request['tbPassword'],
            'dni' => $request['tbDNI'],
            'nombres' => $request['tbFirstName'],
            'apellidos' => $request['tbLastName'],
            'tipo' => $request['selRole'],
            ]);

        Session::flash('message', 'Usuario creado correctamente.');
        return Redirect::to('/admin/usuarios/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Iniciar sesión
     */
    public function login(Request $request) {
        if (Auth::attempt(['user' => $request['tbUser'], 'password' => $request['tbPassword']])) {
            Session::flash('message', 'Bienvenido de nuevo.');
            return Redirect::to('dashboard');
        } else {
            Session::flash('error', 'El usuario o contraseña son incorrectos.');
            return Redirect::to('/');
        }
    }

    /**
     * Iniciar sesión
     */
    public function logout() {
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * Mostrar el Escritorio
     */
    public function dashboard() {
        return view('layouts.dashboard');
    }

    /**
     * Cambiar Contraseña
     */
    public function mostrarPerfil(){
        $configuracion = User::where('id', '=', Auth::user()->id)
                        ->first();
        $nombre = '';
        $apellidos ='';
        if ($configuracion) {            
            $nombre = $configuracion->nombres;
            $apellidos = $configuracion->apellidos;
        }
        return view('layouts.perfil', compact('nombre', 'apellidos'));
    }

    public function guardarPass(Request $request){
        $user = User::find(Auth::user()->id);
        $pass_new = $request['tbPassword'];
        $pass_actual = $request['tbContrasenia'];
        $password = $user->password;

        if(\Hash::check($pass_actual , $password)){
            $user->password = $pass_new;
            $user->save();

            Session::flash('message', 'Contraseña cambiada correctamente');
            return Redirect::to('/dashboard');
        }else{
            Session::flash('message', 'Contraseña Actual incorrecta');
            return Redirect::to('/dashboard');
        }
    }


}
