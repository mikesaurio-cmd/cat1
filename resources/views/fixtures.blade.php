@php
$nombre = auth()->user()->name;
$iduser = auth()->user()->id;
$fixture = DB::table('tbl_fixturesinfo')->get();  

@endphp

@extends('layouts.app')
@section('content')
<div class="container" style="background-color: white; padding: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">

    <h1 class="text-center mt-3">Verificación de Herramientas </h1>
    
    <div class="row">
        <div class="col-md-8"> 
            <div class="border" style="padding: 10px;">
                <p class="text-right mt-1">Socio asignado a la revisión:</p>  
                <div class="col-md-4 offset-lg-8" style="color:white; background-color:black;">
                    
                    <h5 class="text-right mt-3">{!! $nombre !!}</h5>
                </div>
                <h5 class="text-left mt-3"> <b> - </b>IMD428903</h5> 
                <table class="table table-bordered"> 
                    <thead> 
                        <tr> 
                            <th>OP</th>
                            <th>Descripción</th>
                            <th>Revisión</th>
                        </tr> 
                    </thead> 
                    <tbody> 
                        <tr> 
                            <td>1.01</td> 
                            <td>Limpieza General de la pieza</td>
                            <td>
                                <div class="form-check">
                                    <center>
                                    <input type="checkbox" class="form-check-input revision-checkbox" data-toggle="modal" data-target="#myModal">
                                    </center>
                            </div>
                            </td>
                        </tr> 
                        <tr>
                            <td>1.02</td> 
                            <td>Eliminar rebabas, chisporroteo y soldaduras en mal estado de la herramienta</td> 
                            <td>
                                <div class="form-check">
                                    <center>
                                    <input type="checkbox" class="form-check-input revision-checkbox" data-toggle="modal" data-target="#myModal">
                                    </center>
                                </div>
                            </td>
                        </tr>
                    </tbody> 
                </table> 
            </div> 
        </div> 
        <div class="col-md-4">
            <div>
                <img src="/imagenes/pieza.png" alt="" class="img-fluid d-block">
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-4">
            <h3>Tiempo estimado del trabajo:</h3>    
        </div>   
    </div>

    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de Revisión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('fixturesInfo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="hidden" name="fecha" value="{{ now()->toDateString() }}">
                        <input type="text" class="form-control" id="fecha" name="fecha" disabled>
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control" name="usuario" value="[{{ $iduser }}] {{ $nombre }} " disabled>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones:</label>
                        <input type="text" class="form-control" name="observaciones" id="observaciones">
                    </div>
                    <div class="form-group">
                        <label for="tiempo">Tiempo estimado:</label>
                        <input type="date" class="form-control" name="tiempo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form> 
        </div>
    </div>
</div>
<div class="text-center"> 
    <h3><label>¿Está todo correcto?</label><br></h3>
    <button class="btn btn-warning">
        Pasar a siguiente sección de verificación
    </button> <br><br>
</div> 

<script>
    // Obtener la fecha actual
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

    // Asignar la fecha al campo de fecha en el modal
    document.getElementById('fecha').value = date;
</script>
<br><br>
<h2>Historial de la pieza</h2>
    <div class="row">
        <div class="table-responsive col-12">
            <table id="table_id" class="table table-hover table-striped table-responsive-sm activos" style="width:100%">
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Observaciones</th>
                        <th>Tiempo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fixture as $value)
                        <tr>
                            <td>{{$value->idFixtures }}</td>
                            <td>{{$value->usr }}</td>
                            <td>{{$value->observaciones }}</td>
                            <td>{{$value->tiempo }}</td>
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
 