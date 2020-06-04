@extends('layouts.home')
@section('dashboard')
    <div id="accordion" class=" justify-content-end">
        @foreach ($reservas as $reserva)
        <div class="card " id="card{{$reserva->id}}">
            <div class="card-header bg-danger" id="heading{{$reserva->id}}">
                <div class="row"  data-toggle="collapse" data-target="#collapse{{$reserva->id}}" aria-expanded="true" aria-controls="collapse{{$reserva->id}}">
                    <div class="col-6 text-left">
                        <h6>{{$reserva->telefono}}</h6>
                    </div>
                    <div class="col-6 text-right">
                        {{$reserva->fecha}}
                    </div>
                </div>
            </div>
            <div id="collapse{{$reserva->id}}" class="collapse show" aria-labelledby="heading{{$reserva->id}}" data-parent="#card">
                <div class="card-body">
                    <h5>CODIGO: {{$reserva->codigo}}</h5>
                    <p><b>{{$reserva->cantidad}}&nbsp;</b>
                        @if ($reserva->cantidad == 1)
                            persona
                        @else
                            personas
                        @endif
                        &nbsp;mesa:<b>&nbsp;{{$reserva->id_mesaFK}}</b>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection
