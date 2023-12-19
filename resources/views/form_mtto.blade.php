@extends('layouts.app')
@section('content')
<div class="container">

    <h1>Validar Mantenimiento</h1>
    <br>
    <b><label style="color: #E74C3C;">Todos los campos con * son obligatorios</label></b>

    <form action="{{url('validarMtto')}}" method="post">
        @csrf
        <label for="mtto">¿Se realizó de manera correcta el mantenimiento?</label> <label style="color: #E74C3C;">*</label>
            <select id="mtto" name="mantenimiento" class="form-control">
            <option value="">Selecciona una opción</option>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
        <!-- Parte para enviar información -->
        <input type="hidden" name="idRegistro" value="{{ $registro->IdRegistro }}">
        <input type="hidden" name="noRegistro" value="{{ $registro->noRegistro }}">
        <br>
        <label for="observaciones">Observaciones</label> <label style="color: #E74C3C;">*</label>
        <input type="text" class="form-control" name="observaciones">
        <br>
        <label for="fechaRevision">Fecha de revisión</label> <label style="color: #E74C3C;">*</label>
        <input type="date" class="form-control" name="fechaRevision">
        <br>
        <label for="fechaMtto">Fecha de próximo mantenimiento</label> <label style="color: #E74C3C;">*</label>
        <input type="date" class="form-control" name="fechaMtto">
        <br>
        
        <input type="submit" value="Enviar" class="btn btn-success">
        <a href="{{url('home')}}" class="btn btn-primary">Regresar</a>

        </div>
    </form>
    
</div>
@endsection
