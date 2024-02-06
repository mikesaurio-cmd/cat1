@extends('layouts.app')
@section('content')
<div class="container">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('mensaje') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif 

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Mantenimiento Personalizado</b></div>
                
                <div class="card-body">
                    <b><label style="color: #E74C3C;">Todos los campos con * son obligatorios</label></b>
                    <form action="{{ route('enviarMmtoPerso') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="nopartes"><b>No. de Parte</b></label> <label style="color: #E74C3C;">*</label>
                                <select class="form-control" name="nopartes" id="nopartes">
                                    <option value="">Selecciona no. parte</option>
                                    @foreach($noparte as $value)
                                        <option value="{{ $value->id }}" {{ (old('nopartes') == $value->noParte) ? "selected" : "" }}>{{ $value->noParte }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                        </div>

                        <label for="planta"><b>Planta</b></label><label style="color: #E74C3C;">*</label>
                        <select class="form-control" name="planta" id="planta">
                            <option value="">Selecciona una planta</option>
                            @foreach($planta as $value)
                                <option value="{{ $value->id }}" {{ (old('planta') == $value->id ? "selected":"") }}> {{ $value->nombrePlanta }}</option>
                            @endforeach
                        </select>
                        <br>

                        <label for="nombreMtto"><b>Nombre del mantenimiento</b></label> <label style="color: #E74C3C;">*</label>
                        <input type="text" class="form-control" name="nombreMtto">
                        <br>

                        <div class="row">
                            <div class="col-12">
                                <label for="frecuencia"><b>Frecuencia</b></label> <label style="color: #E74C3C;">*</label>
                                <select class="form-control" name="frecuencia" id="frecuencia">
                                    <option value="">Selecciona</option>
                                    @foreach($frecuencia as $value)
                                        <option value="{{ $value->idFrecuencia }}" {{ (old('idFrecuencia') == $value->nombre ? "selected":"") }}> {{ $value->nombre }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                        </div>
                        
                        <label for="planta"><b>Escribe la descripción del mantenimiento</b></label> <label style="color: #E74C3C;">*</label>
                        <input type="text" class="form-control" name="observacion">
                        <br>
                        
                        <center>
                            <input type="submit" class="btn btn-success" value="Siguiente">
                            <a href="{{url('irmttoperso')}}" class="btn btn-primary">Regresar</a>
                        </center>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
</div>
@endsection
