<h1>{{$modo}} planta</h1>

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach( $errors->all() as $error)
                <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
 @endif
 <b><label style="color: #E74C3C;">Todos los campos con * son obligatorios</label></b>
<div class="form-group">
    <label for="nombrePlanta">Nombre de la planta</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="nombrePlanta" value="{{ isset($planta->nombrePlanta)?$planta->nombrePlanta:old('nombrePlanta')}}"><br>
    
    <label for="contactoPlanta">Nombre del contacto planta</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="contactoPlanta" value="{{ isset($planta->contactoPlanta)?$planta->contactoPlanta:old('contactoPlanta')}}"><br>
    
    <label for="telefonoPlanta">Telefono de la planta</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="telefonoPlanta" value="{{ isset($planta->telefonoPlanta)?$planta->telefonoPlanta:old('telefonoPlanta')}}"><br>
    
    <label for="correoPlanta">Correo de la planta</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="correoPlanta" value="{{ isset($planta->correoPlanta)?$planta->correoPlanta:old('correoPlanta')}}"><br>
    
    <input type="submit" value="{{$modo}} datos" class="btn btn-success">
    <a href="{{url('plantas')}}" class="btn btn-primary">Regresar</a>

</div>

