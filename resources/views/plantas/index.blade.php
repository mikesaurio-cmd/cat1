@extends('layouts.app')

@section('content')

<div class="container">



@if(session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('mensaje') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif





<a href="{{url('plantas/create')}}" class="btn btn-success">Registar nueva Planta</a>

<br><br>



<div class="row">

    <div class="table-responsive col-12">

        <table id="table_id" class="table table-hover table-striped table-responsive-sm activos" style="width:100%">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Nombre</th>

                    <th>Contacto</th>

                    <th>Telefono</th>

                    <th>Correo</th>

                    <th>Acciones</th>

                </tr>

            </thead>



            <tbody>

                @foreach($plantas as $planta)

                <tr>

                    <td>{{$planta->id }}</td>

                    <td>{{$planta->nombrePlanta }}</td>

                    <td>{{$planta->contactoPlanta }}</td>

                    <td>{{$planta->telefonoPlanta }}</td>

                    <td>{{$planta->correoPlanta }}</td>

                    <td>



                        <a href="{{url ('/plantas/'.$planta->id.'/edit') }}" class="btn btn-warning">

                            Editar

                        </a>

                        |                

                        <form action="{{ url('/plantas/'.$planta->id) }}" method="post" class="d-inline">

                            @csrf

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

@endsection