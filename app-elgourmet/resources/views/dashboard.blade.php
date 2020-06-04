@extends('layouts.home')

@section('dashboard')

<div id="accordion">
<div class="row">
    <div class="col-12 text-right">
        <h3>
            <i class="fas fa-cogs"></i>
        </h3>

    </div>
</div>
  <div class="card">
    <div class="card-header bg-danger" id="headingOne">
      <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Usuario
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <form method="POST" action="/home/config_user">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Correo electrónico</label>
              <input type="email" class="form-control" value=" {{ Auth::user()->email }}" disabled>
            </div>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" value=" {{ Auth::user()->name }}" name="name">
              </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contraseña</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nueva contraseña" name="password" pattern=".{6,}">
              <small>Al enviar el formulario se sobrescribirá el nombre y la contraseña actual</small>
            </div>
            <button type="submit" class="btn btn-danger">Enviar</button>
          </form>
     </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header bg-danger" id="headingTwo">
      <h5 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          Restaurante
      </h5>
    </div>

    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
          @if (isset($restaurante))
          <form method="POST" action="/home/config_restaurante">
            @csrf
            <div class="form-group">
              <label for="nombre">Nombre restaurante</label>
              <input type="nombre" class="form-control" name="nombre" value="{{ $restaurante->nombre }}">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" value=" {{  $restaurante->direccion }}" name="direccion">
                <small>Al enviar el formulario se sobrescribirá el nombre y la direccion de su restaurante</small>
            </div>
            <button type="submit" class="btn btn-danger">Enviar</button>
          </form>
          @else
              <h6 class="text-danger">Parece que no ha creado ningún restaurante, rellene el formulario para comenzar.</h6>
              <form method="POST" action="/home/config_restaurante">
                @csrf
                <div class="form-group">
                  <label for="nombre">Nombre restaurante</label>
                  <input type="nombre" class="form-control" name="nombre" value="" placeholder="Nombre restaurante">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" value="" name="direccion" placeholder="Dirección">
                </div>
                <button type="submit" class="btn btn-danger">Enviar</button>
              </form>
          @endif

     </div>
    </div>
    @if (isset($restaurante))
    <div class="card">
        <div class="card-header bg-danger bg-danger" id="headingThree">
          <h5 class="mb-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
              Mesas
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body row justify-content-around">
                @if (isset($mesas) && count($mesas)>0)
                    @foreach ($mesas as $mesa)
                    <div class="card col-10 col-md-5 bg-info text-center mb-3">
                        <form action="/home/config_mesas" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$mesa->id}}">
                            <div class="form-group">
                                <label for="nombre">Nombre mesa</label>
                                <input type="text" class="form-control" name="nombre" value="{{$mesa->nombre}}">
                            </div>
                            <div class="form-group">
                                <label for="capacidad">Capacidad</label>
                                <input type="number" class="form-control" name="capacidad" value="{{$mesa->capacidad}}">
                            </div>
                            <div class="d-flex justify-content-around">
                                <button class="btn text-warning" type="submit" name="editar" value="1">Editar</button><button class="btn text-warning" type="submit" name="eliminar" value="1">Eliminar</button>
                            </div>
                        </form>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <h6 class="text-danger">Parece que no tienes ninguna mesa.</h6>
                    </div>
                @endif
                <div class="col-12">
                    <hr>
                </div>
                <div class="card col-10 col-md-5 bg-primary text-center">
                    <form action="/home/config_mesas" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre mesa</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre mesa" required>
                        </div>
                        <div class="form-group">
                            <label for="capacidad">Capacidad</label>
                            <input type="number" class="form-control" name="capacidad" placeholder="Ej: 4" required>
                        </div>
                        <div class="">
                            <button class="btn text-warning" type="submit" name="crear" value="1">Crear mesa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
  </div>


</div>

@endsection
