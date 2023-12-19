<h1>{{$modo}} No. de Parte</h1>

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
    <label for="noParte">No. de la Parte</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="noParte" value="{{ isset($nopartes->noParte)?$nopartes->noParte:old('noParte')}}"><br>
    
    <label for="nombreParte">Nombre de  la parte</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="nombreParte" value="{{ isset($nopartes->nombreParte)?$nopartes->nombreParte:old('nombreParte')}}" ><br>
    
    <label for="descriParte">Descripción</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="descriParte" value="{{ isset($nopartes->descripcion)?$nopartes->descripcion:old('descriParte')}}"><br>
    
    <input type="submit" value="{{$modo}} datos" class="btn btn-success">
    <a href="{{url('nopartes')}}" class="btn btn-primary">Regresar</a>

</div>

