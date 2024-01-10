@extends('layouts.app')
@section('content')
<div class="container">
@php
    $planta = DB::table('plantas')->get();
@endphp

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach( $errors->all() as $error)
                <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
 @endif


 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{$modo}} usuario</b></div>
                
                <div class="card-body">
                    <b><label style="color: #E74C3C;">Todos los campos con * son obligatorios</label></b>

                    <form action="{{ route('sendEdit') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" class="form-control" name="id" value="{{$infoUser->id}}"><br>
                    <div class="form-group">
                        <label for="name">Nombre Completo</label><label style="color: #E74C3C;">*</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ isset($infoUser->name)?$infoUser->name:old('name')}}"><br>

                        <label for="email">Correo</label><label style="color: #E74C3C;">*</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ isset($infoUser->email)?$infoUser->email:old('email')}}"><br>

                        <label for="password">Contraseña</label><label style="color: #E74C3C;">*</label>
                        <input type="password" class="form-control" name="password" id="password"><br>

                        <label for="idPlanta">Planta</label> <label style="color: #E74C3C;" value="{{ isset($infoUser->idPlanta)?$infoUser->idPlanta:old('idPlanta')}}">*</label>
                        <select class="form-control" name="idPlanta" id="idPlanta">
                            <option value="">Selecciona una opción</option>
                            @foreach($planta as $value)
                                <option value="{{ $value->id }}" {{ (old('noParte') == $value->id ? "selected":"") }}> {{ $value->nombrePlanta }}</option>
                            @endforeach
                        </select>
                        <br>

                        <label for="role">Asignar Rol</label> <label style="color: #E74C3C;">*</label>
                        <select class="form-control" name="role" id="role">
                            <option value="">Selecciona una opción</option>
                            <option value="admin" >Admin</option>
                            <option value="usuario" >Usuario</option>
                        </select>
                        <br>
                        <center>
                            <input type="submit" value="{{$modo}} datos" class="btn btn-success">

                            <a href="{{url('empleado')}}" class="btn btn-primary">Regresar</a>
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

