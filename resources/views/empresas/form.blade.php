<h1>{{$modo}} empresa</h1>

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
    <label for="nombreEmpresa">Nombre de la Empresa</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="nombreEmpresa" value="{{ isset($empresa->nomEmpresa)?$empresa->nomEmpresa:old('nombreEmpresa')}}"><br>
    
    <label for="contacto">Nombre del contacto</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="contacto" value="{{ isset($empresa->contacto)?$empresa->contacto:old('contacto')}}" id="nombre"><br>
    
    <label for="telefono">Telefono</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="telefono" value="{{ isset($empresa->telefono)?$empresa->telefono:old('telefono')}}"><br>
    
    <label for="correo">Correo</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="correo" value="{{ isset($empresa->correo)?$empresa->correo:old('correo')}}"><br>
    
    <input type="submit" value="{{$modo}} datos" class="btn btn-success">
    <a href="{{url('empresas')}}" class="btn btn-primary">Regresar</a>

</div>

