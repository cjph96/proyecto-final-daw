<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\Restaurante;
use App\Mesa;
use Illuminate\Support\Carbon;
use \stdClass;
use App\Http\Resources\ReservaResource;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 'GET';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $min_time = 30;//Tiempo minimo entre reservas
        $id_Restaurante =  $request->input('id_Restaurante');
        $cantidad =  $request->input('cantidad');
        $fecha =  $request->input('fecha');
        $telefono =  $request->input('telefono');

        if(     !isset( $id_Restaurante )
            ||  !isset( $cantidad )
            ||  !isset( $fecha )
            ||  !isset( $telefono )
        ){

            return response('Faltan parametros por rellenar', 400)
                ->header('Content-Type', 'text/plain');
        }

        $restaurante = Restaurante::where('id','=', $id_Restaurante)->first();
        if( is_null($restaurante) ){
            return response('No hay ningun restaurante con el id indicado', 400)
                ->header('Content-Type', 'text/plain');
        }

        $reserva = new Reserva;
        $reserva->telefono = $telefono;
        $reserva->cantidad = $cantidad;
        $reserva->fecha = $fecha;
        $reserva->estado = 0;
        $reserva->codigo = $restaurante->id . rand( 1000 , 9999 );

        //Validaciones reserva
        //mesas
        $mesas_ALL = Mesa::where([
            ['id_RestauranteFK','=', $restaurante->id],
            ['capacidad','>=', $cantidad]
        ])->orderBy('capacidad', 'asc')
        ->get();

        $fecha_carbon = Carbon::parse($fecha); //fecha casted a Carbon
        $now_5 = Carbon::now()->addMinutes(5);
        if( $fecha_carbon->lessThan($now_5) ){
            return response('Solo se admiten reservas con un minimo de 5 minutos de antelacion', 400)
                ->header('Content-Type', 'text/plain');
        }

        $fecha_min = Carbon::parse($fecha)->subMinutes($min_time);
        $fecha_max = Carbon::parse($fecha)->addMinutes($min_time);

        foreach ($mesas_ALL as $mesa) {
            //reservas
            $reservas_ALL = Reserva::where([
                ['id_MesaFK','=', $mesa->id],
                ['fecha','>', $fecha_min],
                ['fecha','<', $fecha_max]
            ])
                ->orderBy('fecha', 'asc')
                ->get();
            if(count($reservas_ALL) == 0){
                $reserva->id_mesaFK = $mesa->id;
                //*BASICO SIN SMS///////////////////////////////////////////////
                $reserva->save();
                return response('El código de su reserva es:' . $reserva->codigo, 200)
                    ->header('Content-Type', 'text/plain');
                /*//////////////////////////////////////////////////////////////
                /*******************VERIFICACION CON SMS********************** */
                $res = $this->enviar_mensaje($reserva->telefono,$reserva->codigo);
                if($res){
                    $reserva->save();
                    return response('El código de su reserva es:' . $reserva->codigo, 200)
                        ->header('Content-Type', 'text/plain');
                }else{
                    return response('No se ha podido enviar un sms de confirmacion', 400)
                        ->header('Content-Type', 'text/plain');
                }
                /*******************VERIFICACION CON SMS********************** */
            }
        }

        return response('No hay ninguna mesa disponible para ese periodo de tiempo', 400)
            ->header('Content-Type', 'text/plain');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }

    //Funcion para enviar mensajes de SMS
    private function enviar_mensaje(String $telefono, String $codigo)
    {
        $peticion = new stdClass();
        $peticion->api_key = 'b525888ded3845b880bfa0f8675ffbec';
        $peticion->report_url = 'http://cristianperez.tk/api/sms';
        $peticion->concat = 1;

        $messages = [];

        $message = new stdClass();
        $message->from = 'El Gourmet';
        $message->to = '34'.$telefono;
        $message->text = 'Su codigo es: '.$codigo;
        $message->custom = 'dasdasda';
        $message->send_at = Carbon::now()->format('Y-m-d H:i:s');

        array_push($messages,$message);

        $peticion->messages = $messages;

        //INICIO API
        $peticion_JSON = json_encode($peticion);
        $headers = array('Content-Type: application/json');

        $ch = curl_init('https://api.gateway360.com/api/3.0/sms/send');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $peticion_JSON);

        $result = curl_exec($ch);

        if (curl_errno($ch) != 0 ){
            return false;
        }
        return true;

    }
    public function SMS(Request $request)
    {
        $payload= $request->getContent();
        $myfile = fopen("C:\server\payload.txt", "a");
        fwrite($myfile, $payload);
        fclose($myfile);
        return $payload;
    }

    public function confirmar_view(Request $request)
    {

        return view('confirmar' );
    }

    public function confirmar(Request $request)
    {
        $codigo =  $request->input('codigo');
        $reserva = Reserva::where('codigo','=',$codigo)->first();

        //var_dump($reserva);exit();
        if( isset($reserva) ){
            $reserva->estado = 1;
            $reserva->save();
            return response('CODIGO CONFIRMADO', 200)
                ->header('Content-Type', 'text/plain');
        }
        return response('NO EXISTE EL CODIGO INTRODUCIDO', 200)
                ->header('Content-Type', 'text/plain');
    }
}
