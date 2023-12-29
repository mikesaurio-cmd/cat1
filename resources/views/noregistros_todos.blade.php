@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('mensaje') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<a href="{{ route('formulario') }}" class="btn btn-success">Nuevo Registro</a>
<br><br>
<h2>Todos los registros</h2>
<div class="row">
    <div class="table-responsive col-12">
        <table id="table_id" class="table table-hover table-striped table-responsive-sm activos" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Empresa</th>
                    <th>Planta</th>
                    <th>No Parte</th>
                    <th>Numero de Registro</th>
                    <th>Fecha mantenimiento</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                    <th>Descargar PDF</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $value)
                    <tr>
                        <td>{{$value->IdRegistro }}</td>
                        <td>{{$value->empresa  }}</td>
                        <td>{{$value->planta  }}</td>
                        <td>{{$value->noparte  }}</td>
                        <td>{{$value->noRegistro  }}</td>
                        <td>{{$value->updateCreation  }}</td>
                        <td>
                            @php
                            $fechaMantenimiento = new DateTime($value->updateCreation);
                            $fechaActual = new DateTime();

                            $diferencia = $fechaMantenimiento->diff($fechaActual);

                            if ($diferencia->m > 1) {
                                $resultado = '<span class="badge badge-success">Más de un mes</span>';
                            } elseif ($diferencia->m == 1) {
                                $resultado = '<span class="badge badge-warning">Un mes de anticipación</span>';
                            } elseif ($diferencia->m < 1) {
                                $resultado = '<span class="badge badge-danger">Menos de un mes</span>';
                            }
                            @endphp
                            {!! $resultado !!}
                        </td>
                        <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{ $value->noRegistro }}">Ver QR</button>
                        </td>
                        <td><button class="btn btn-success"><a href="{{ route('imprimir', ['IdRegistro' => $value->IdRegistro, 'noRegistro' => $value->noRegistro]) }}" style="color: white;">PDF</a></button></td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para ver QR -->
@foreach($datos as $value)
    <div class="modal fade" id="myModal-{{ $value->noRegistro }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">QR de la pieza</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"> <!-- Centra el contenido -->
                    <h4 style="color: red;">Escanea el código QR</h4>

                    <img src="{{ asset('qr_codes/' . $value->noRegistro . '.png') }}" alt="QR Code" width="200">
                    
                    <br>
                    <br>

                    <a href="{{ route('mostrarInformacion', ['id' => $value->noRegistro]) }}" class="btn btn-success">Mostrar Información</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ por página",
                "zeroRecords": "No encontrado",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "No se encontraron registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:", // Cambiamos "Filtrar" por "Buscar"
                "paginate": {
                    "first": "Primero",
                    "previous": "Anterior",
                    "next": "Siguiente",
                    "last": "Último"
                }
            },
            "order": [[0, "asc"]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
        });
    } );
</script>



</div>
@endsection
