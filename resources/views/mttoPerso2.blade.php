
@extends('layouts.app')
@section('content')


@php
    $frecInfo = DB::table('tbl_frecuencias')->where('idFrecuencia', $info->frecuencia)->first();
    $noParteInfo = DB::table('nopartes')->where('id', $info->noParte)->first();
    $plantaInfo = DB::table('plantas')->where('id', $info->planta)->first();
@endphp

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
                <div class="card-header"><b>Validar Información</b></div>
                
                <div class="card-body">
                    <form action="{{ route('validarinfo') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        
                        <label for="nombreMtto"><b>Nombre del Mantenimiento</b></label> 
                        <input type="text" class="form-control" name="nombreMtto" value="{{$info->nombreMtto}}" disabled>
                        <br>

                        <label for="noParte"><b>No. de Parte</b></label> 
                        <input type="text" class="form-control" name="noParte" value="{{$noParteInfo->nombreParte}}" disabled>
                        <br>

                        <label for="planta"><b>Planta</b></label> 
                        <input type="text" class="form-control" name="planta" value="{{$plantaInfo->nombrePlanta}}" disabled>
                        <br>

                        <label for="frecuencia"><b>Frecuencia</b></label> 
                        <input type="text" class="form-control" name="frecuencia" value="{{$frecInfo->nombre}}" disabled>
                        <br>

                        <label for="observacion"><b>observación</b></label> 
                        <input type="text" class="form-control" name="observacion" value="{{$info->observacion}}" disabled>
                        <br>

                        <label for="costo"><b>Costo</b></label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="number" min="0" class="form-control" name="costo" aria-label="Amount (to the nearest dollar)">
                        </div>
                        <br>

                        <input type="hidden" name="idMtto" value="{{ $info->idMtto }}">
                        <center>
                            <input type="submit" class="btn btn-success" value="Enviar">
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
