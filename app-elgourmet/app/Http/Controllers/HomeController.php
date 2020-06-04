<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Carbon\Carbon;

use App\Restaurante;
use App\Mesa;
use App\Reserva;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $restaurante = Restaurante::where('id_userFK','=',$user->id)->first();
        $mesas = Mesa::where('id_restauranteFK','=',$restaurante->id)->get();

        //var_dump($mesas);exit();

        return view('dashboard', ['restaurante' =>  $restaurante, 'mesas' =>  $mesas,] );
    }

    /**
     * name,pass de usuario
     */
    public function config_user(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');

        $pass =  $request->input('password');
        if($pass != "")
            $user->password = Hash::make($pass);

        $user->save();

        return redirect('/home');
    }
    /**
     * bar del usuario
     */
    public function config_restaurante(Request $request)
    {
        $nombre =  $request->input('nombre');
        $direccion =  $request->input('direccion');
        $user = Auth::user();


        $restaurante = Restaurante::where('id_userFK','=',$user->id)->first();
        if( ! isset($restaurante)){
            $restaurante = new Restaurante;
            $restaurante->id_userFK = $user->id;
        }

        $restaurante->nombre = $nombre;
        $restaurante->direccion = $direccion;
        $restaurante->save();

        return redirect('/home');
    }

    public function config_mesas(Request $request)
    {
        $nombre =  $request->input('nombre');
        $capacidad =  $request->input('capacidad');
        $id_mesa =  $request->input('id');

        $user = Auth::user();
        $restaurante = Restaurante::where('id_userFK','=',$user->id)->first();

        //Eliminar
        $eliminar = $request->input('eliminar');
        if(isset( $eliminar)){
            $mesa = Mesa::where('id','=',$id_mesa)->first();
            $mesa->delete();
        }

        //Editar
        $editar = $request->input('editar');
        if( isset( $editar) ){
            $mesa = Mesa::where('id','=',$id_mesa)->first();
            $mesa->nombre = $nombre;
            $mesa->capacidad = $capacidad;
            $mesa->save();
        }

        //Crear
        $crear = $request->input('crear');
        if(isset($crear)){
            $mesa = new Mesa;
            $mesa->nombre = $nombre;
            $mesa->capacidad = $capacidad;
            $mesa->id_restauranteFK = $restaurante->id;
            $mesa->save();
        }

        return redirect('/home');
    }

    public function reservas_view(Request $request)
    {
        $user = Auth::user();
        $restaurante = Restaurante::where('id_userFK','=',$user->id)->first();
        $mesas = Mesa::where('id_restauranteFK','=',$restaurante->id)->get();
        $mesas_id = [];
        $mesas_nombre = [];
        foreach ($mesas as $mesa) {
            array_push($mesas_id,$mesa->id);
            $mesas_nombre[$mesa->id] = $mesa->nombre;
        }
        //Todas las reservas pendientes (incluidas ultimas 24horas)
        $reservas = Reserva::whereIn('id_mesaFK',$mesas_id)
            ->where('fecha','>',Carbon::now()->subDay())
            ->orderBy('fecha', 'asc')
            ->get();

            //var_dump($mesas_id);var_dump($reservas);exit();
        return view('reservas', ['reservas' =>  $reservas, 'mesas' => $mesas_nombre ] );
    }

}
