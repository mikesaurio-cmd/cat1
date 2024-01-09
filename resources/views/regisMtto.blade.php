@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('mensaje') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h2><b>Registros de Mantenimiento</b></h2>
<a href="{{ route('mmtoPerso') }}" class="btn btn-warning">Nuevo Mantenimiento</a>
<br><br>

<div class="row">
    <div class="table-responsive col-12">
        <table id="table_id" class="table table-hover table-striped table-responsive-sm activos" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del Mtto</th>
                    <th>No Parte</th>
                    <th>Planta</th>                    
                    <th>Frecuencia</th>
                    <th>Observación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $value)
                    <tr>
                        <td>{{$value->idMtto }}</td>
                        <td>{{$value->nombreMtto }}</td>
                        <td>{{$value->noParte }}</td>
                        <td>{{$value->planta }}</td>
                        <td>{{$value->frecuencia }}</td>
                        <td>{{$value->observacion }}</td>
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
