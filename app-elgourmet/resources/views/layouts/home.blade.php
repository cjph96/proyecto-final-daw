@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-12 col-md-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="/home" class="text-warning">
                        <h5>
                            <i class="fas fa-cogs"></i> Configuracion
                        </h5>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="/home/reservas" class="text-warning">
                        <h5>
                            <i class="fas fa-book-open"></i> Reservas
                        </h5>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-8">
            @yield('dashboard')
        </div>
    </div>
</div>
@endsection
