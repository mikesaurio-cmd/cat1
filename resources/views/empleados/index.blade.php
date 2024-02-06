@extends('layouts.app')
@section('content')
<div class="container">


@auth
@if (auth()->user()->role == 'admin')

@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('mensaje') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



<a href="{{url('empleado/create')}}" class="btn btn-success">Registrar nuevo usuario</a>
<br><br>
<div class="row">
    <div class="table-responsive col-12">
        <table id="table_id" class="table table-hover table-striped table-responsive-sm activos" style="width:100%">
            <thead>
                <tr>
                <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Planta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach( $user as $value) 
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email  }}</td>
                    <td>{{ $value->role }}</td>
                    <td>{{ $value->idPlanta }}</td>
                    <td>
                        <form action="{{ url('/empleado/'.$value->id) }}" method="post" class="d-inline">
                            @csrf
                            <a href="{{url ('/empleado/'.$value->id.'/edit') }}" class="btn btn-warning">
                            Editar
                            </a>
                            |  
                            {{method_field('DELETE')}}
                            <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar" class="btn btn-danger">
                        </form>
                    </td>
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
@else
@endif
    @endauth


@endsection