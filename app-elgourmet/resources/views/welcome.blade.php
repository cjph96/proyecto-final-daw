<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

       <!-- Scripts -->

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/c8423cf0ce.js" crossorigin="anonymous"></script>

        <!--Datatable -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/r-2.2.5/sc-2.0.2/sl-1.3.1/datatables.min.css"/>

        <style>
            table.dataTable tbody tr.selected {
                background-color: #dc3545;
            }
        </style>

    </head>
    <body class="text-warning bg-light">
        <!-- Modal -->
        <div class="modal fade" id="reservaModal" tabindex="-1" role="dialog" aria-labelledby="reservaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="reservaModalLabel">Datos reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="/api/reservar" method="post" id="reservarform">
                        <input type="hidden" id="id_Restaurante" name="id_Restaurante" value="">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nombre_Restaurante" name="nombre_Restaurante" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Nº de personas</label>
                            <input type="number"  class="form-control" name="cantidad" value="" required min="1">
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="datetime-local" class="form-control" name="fecha" value="" required >
                        </div>
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="number" class="form-control" name="telefono" value="" required placeholder="Ej: 612345678" pattern=".{9,}" max="699999999">
                        </div>
                        <button class="btn btn-danger text-warning" type="submit" name="editar" value="1">Reservar</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal::end -->
        <br>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <h2>{{ config('app.name', 'Laravel') }} <i class="fas fa-utensils"></i></h2>
                </div>
                <div class="col-3">
                    <a class="text-danger" href="/home">
                        <h6>
                            @auth
                                <i class="fas fa-user"> &nbsp; &nbsp; </i>{{ Auth::user()->name }}
                            @endauth
                            @guest
                                {{ __('Login') }}
                            @endguest
                        </h6>
                    </a>
                </div>
                <div class="col-12" id="events">

                </div>
                <div class="col-12 text-center">
                    <h5>Restaurantes</h5>
                    <table id="myTable" class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-12 pt-2">
                    <button class="btn btn-danger" value="" id="reservar" data-toggle="modal" data-target="#reservaModal" disabled>Seleccione un restaurante</button>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/r-2.2.5/sc-2.0.2/sl-1.3.1/datatables.min.js"></script>
    <script src="/assets/scripts/malsup.js"></script><!--Script para formularios ajax -->
    <script>
        $(document).ready( function () {
            var events = $('#events');
            var reservar = $('#reservar');
            var table =$('#myTable').DataTable({
                "ajax": "/api/restaurantes",
                "columns": [
                    { "data": "nombre" },
                    { "data": "direccion" },
                    {"data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [ 2 ],
                        "visible": false
                    }
                ],
                'select': 'single',
                "scrollY": "535px",
                "scrollCollapse": true,
                "lengthChange": false,
                "info": false,
                "paging": false,
                "language": {
                    "info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "lengthMenu":     "Mostrar _MENU_ entradas",
                    "info": " _START_-_END_ de _TOTAL_",
                    "search":         "Filtrar:",
                    "zeroRecords":    "No se han encontrado resultados",
                    "infoFiltered":   "",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Ultimo",
                        "next":       "<i class='fas fa-arrow-right'></i>",
                        "previous":   "<i class='fas fa-arrow-left'></i>"
                    },
                    searchPanes: {
                        clearMessage: 'Eliminar filtros',
                        collapse: {0: 'Filtro', _: 'Filtros (%d)'}
                    }
                },
            });//FINAL DATATABLE

            table
                .on( 'select', function ( e, dt, type, indexes ) {
                    var rowData = table.rows( indexes ).data().toArray()[0];
                    $('#reservar').html('<h5>Reservar</h5>').prop('disabled', false);
                    $('#id_Restaurante').val(rowData.id);
                    $('#nombre_Restaurante').val(rowData.nombre);
                    //$('#reservar').val(rowData.id);
                } )
                .on( 'deselect', function ( e, dt, type, indexes ) {
                    $('#reservar').html('Seleccione un restaurante').prop('disabled', true);
                    $('#id_Restaurante').val('');
                    $('#nombre_Restaurante').val('');
                    //$('#reservar').val('');
                } );

            //formurioajax
            $('#reservarform').ajaxForm(
                    {
                        contentType: "application/x-www-form-urlencoded"
                        ,error:function(data,s,m){
                            window.alert(data.responseText)
                        }
                        ,success:function(data){
                            window.alert(data);
                            window.location.href = "/confirmar";
                            //let dataJSON = JSON.parse(data);
                            /*
                            let usuario =  dataJSON['usuario'];
                            let ultima_ficha = 'SALIDA';
                            if(dataJSON['ultima_ficha'].tipo == 1)
                                ultima_ficha = 'ENTRADA';
                            let fecha = dataJSON['ultima_ficha'].created_at;
                            $("#nombre").append('<h6>' + usuario.nombre + ' ' + usuario.apellido + '</h6>');
                            $("#ultima_ficha").append('<h6>' + ultima_ficha +':</h6>');
                            $("#ultima_ficha").append('<small>'+fecha+'</small>');
                            $('#exampleModal').modal('toggle');
                            */
                        }
                    }
                );

        } );//FINAL READY
    </script>
</html>
