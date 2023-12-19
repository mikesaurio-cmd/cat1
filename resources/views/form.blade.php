@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('mensaje') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif 

    <h1>Tarjeta de informe</h1>
    <br>
    <b><label style="color: #E74C3C;">Todos los campos con * son obligatorios</label></b>
    <form action="{{ route('enviarInfo') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">

        <label for="noParte">Empresa</label> <label style="color: #E74C3C;">*</label>
        <select class="form-control" name="noParte" id="noParte">
            <option value="">Selecciona una empresa</option>
            @foreach($empresa as $value)
                <option value="{{ $value->id }}" {{ (old('noParte') == $value->id ? "selected":"") }}> {{ $value->nomEmpresa }}</option>
            @endforeach
        </select>
        <br>
        
        <div class="mb-3">
            <label for="imagenInput" class="form-label">Selecciona imagen</label><label style="color: #E74C3C;">*</label>
            <input type="file" class="form-control" id="imagenInput" name="imagen" >
        </div>

        <label for="planta">Planta</label> <label style="color: #E74C3C;">*</label>
        <select class="form-control" name="planta" id="planta">
            <option value="">Selecciona una planta</option>
            @foreach($planta as $value)
                <option value="{{ $value->id }}" {{ (old('planta') == $value->id ? "selected":"") }}> {{ $value->nombrePlanta }}</option>
            @endforeach
        </select>
        <br>

        <div class="row">
            <div class="col-4">
                <label for="noparte">No. de Parte</label> <label style="color: #E74C3C;">*</label>
                <select class="form-control" name="noparte" id="noparte">
                    <option value="">Selecciona no. parte</option>
                    @foreach($noparte as $value)
                        <option value="{{ $value->noParte }}" {{ (old('noparte') == $value->noParte ? "selected":"") }}> {{ $value->noParte }}</option>
                    @endforeach
                </select>
                <br>
            </div>
            <div class="col-4">
                <label for="cantidad">Cantidad de partes</label><label style="color: #E74C3C;">*</label>
                <input type="number" class="form-control" name="cantidad" placeholder="Escriba cantidad">
            </div>
            <div class="col-4">
                <label for="mantenimiento">Fecha de mantenimiento</label><label style="color: #E74C3C;">*</label>
                <input type="date" class="form-control" name="mantenimiento">
            </div>
        </div>
        
        
        <input type="submit" class="btn btn-success">
        <a href="{{url('home')}}" class="btn btn-primary">Regresar</a>

        </div>
    </form>
    
</div>
@endsection
