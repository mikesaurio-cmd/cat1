@extends('layouts.app')
@section('content')
<div class="container">

    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('mensaje') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-7">
            <h1><b> Información del QR </b></h1>
        </div>
        @php
            $fechaMantenimiento = new DateTime($registro->updateCreation);
            $fechaActual = new DateTime();

            $diferencia = $fechaMantenimiento->diff($fechaActual);

            if ($diferencia->m > 1) {
                $resultado = '<span class="badge badge-success badge-h3">Más de un mes</span>';
            } elseif ($diferencia->m == 1) {
                $resultado = '<span class="badge badge-warning badge-h3">Un mes de anticipación</span>';
            } elseif ($diferencia->m < 1) {
                $resultado = '<span class="badge badge-danger badge-h3">Menos de un mes</span>';
            }
        @endphp
        <style>
            .badge-h3 {
                font-size: 1.0rem;
                margin: 10px;
            }
        </style>

        <div class="col-12 col-md-5">
            <label for="idRegistro" class="h3" style="font-weight: bold;">Próximo Mantenimiento</label>{!! $resultado !!}
            <input id="idRegistro" class="form-control" value="{{ $registro->updateCreation }}" disabled>
        </div>
        
    </div>
    <br>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="idRegistro" style="font-weight: bold;">Id de Registro:</label>
                <input id="idRegistro" class="form-control" value="{{ $registro->IdRegistro }}" disabled>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="noParte" style="font-weight: bold;">No Parte:</label>
                <input id="noParte" class="form-control" value="{{ $registro->noparte }}" disabled>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for "codigoParte" style="font-weight: bold;">Código de parte:</label>
                <input id="codigoParte" class="form-control" value="{{ $registro->noRegistro }}" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="empresa" style="font-weight: bold;">Empresa:</label>
                <input id="empresa" class="form-control" value="[{{ $registro->empresa }}] {{ $empresa->nomEmpresa }}" disabled>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="planta" style="font-weight: bold;">Planta:</label>
                <input id="planta" class="form-control" value="[{{ $registro->planta }}] {{ $planta->nombrePlanta }}" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        
        <center>
            @if(auth()->user()->idPlanta == 4 || auth()->user()->idPlanta == 'Simasa')
                <a href="{{ route('fixture',['id' => $registro->IdRegistro]) }}" class="btn" style="background-color:#FF6D00;color:white">Fixtures</a>
            @endif

            <a href="{{ route('irmtto',['id' => $registro->IdRegistro]) }}" class="btn btn-warning" style="color:white">Validar mantenimiento</a>
            <a href="javascript:history.back()" class="btn btn-primary">Regresar</a>
            @if($registro->img)
                <a href="{{ $registro->img }}" download class="btn btn-success">Descargar archivos</a><br><br>

                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="max-width: 400px; margin: auto;">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ $registro->img }}" class="d-block w-200" alt="Imagen del mantenimiento" style="max-height: 200px;">
                        </div>
                    </div>
                    
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>

            @else
                <center>
                    <br><br>
                    <img src="/imagenes/imgNoDisp.jpg" class="d-block w-200" style="max-height: 200px;" title="No hay archivo para descargar.">
                    <br><br>
                </center>
            @endif
            
            
        </center>

        </div>
    </div>
    <br>
    <h2>Historial de la pieza</h2>
    <div class="row">
        <div class="table-responsive col-12">
            <table id="table_id" class="table table-hover table-striped table-responsive-sm activos" style="width:100%">
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Id Registro</th>
                        <th>No Registro</th>
                        <th>Mantenimiento</th>
                        <th>Observaciones</th>
                        <th>Fecha de revisión</th>
                        <th>Próximo Mantenimiento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mtto as $value)
                    <tr>
                        <td>{{$value->idMtto}}</td>
                        <td>{{$value->idRegistro }}</td>
                        <td>{{$value->noRegistro }}</td>
                        @php
                        if($value->mtto == 0) {
                                $resultado = '<span class="badge badge-danger">De manera no correcta</span>';
                            } elseif ($value->mtto == 1) {
                                $resultado = '<span class="badge badge-success">De manera correcta</span>';
                            }
                        @endphp
                        <td>{!! $resultado !!}</td>
                        <td>{{$value->observaciones }}</td>
                        <td>{{$value->fechaRevision }}</td>
                        <td>{{$value->proxMtto }}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
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
