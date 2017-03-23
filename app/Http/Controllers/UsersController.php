<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;
use App\SaleSession;
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
    $usuarios = User::all();
    return view('admin.users.index', ['usuarios' => $usuarios]);
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
      'estado' => $request['estado'],
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
    $usuario = User::find($id);
    return view('admin.users.edit', ['usuario' => $usuario]);
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
    $usuario = User::find($id);
    if ($usuario) {
      $usuario->user = $request['tbUser'];
      $usuario->dni = $request['tbDNI'];
      $usuario->nombres = $request['tbFirstName'];
      $usuario->apellidos = $request['tbLastName'];
      $usuario->tipo = $request['selRole'];
      $usuario->estado = $request['estado'];
      $usuario->save();
      Session::flash('message', 'Usuario actualizado correctamente.');
      return Redirect::to('admin/usuarios');
    } else {
      Session::flash('message', 'Error.');
      return Redirect::to('admin/usuarios');
    };
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $respuesta = [];
    try {
      $usuario = User::find($id);
      if ($usuario) {
        $nro_ventas = Sale::where('id_usuario', $id)->count();
        $nro_sesiones = SaleSession::where('id_usuario', $id)->count();
        if ($nro_ventas == 0 && $nro_sesiones == 0) {
          $usuario->delete();
          $respuesta['resultado'] = 'true';
        } else {
          $respuesta['resultado'] = 'false';
          $respuesta['mensaje'] = 'Usuario ya realizó alguna operación.';
        }
      }
      else {
        $respuesta['resultado'] = 'false';
        $respuesta['mensaje'] = 'Usuario no existe.';
      }
    } catch (\Exception $e) {
      $respuesta['resultado'] = 'false';
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $respuesta;
  }

  /**
   * Iniciar sesión
   */
  public function login(Request $request) {
    if (Auth::attempt(['user' => $request['tbUser'], 'password' => $request['tbPassword']])) {
      $estado = Auth::user()->estado;
      if ($estado == 1) {
        Session::flash('message', 'Bienvenido de nuevo.');
        return Redirect::to('dashboard');
      } else {
        Session::flash('error', 'El usuario no se encuentra habilitado.');
        return Redirect::to('/');
      }
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
