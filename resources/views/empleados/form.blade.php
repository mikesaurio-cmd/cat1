@php
    $planta = DB::table('plantas')->get();
@endphp



<h1>{{$modo}} empleado</h1>

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
    <label for="name">Nombre Completo</label><label style="color: #E74C3C;">*</label>
    <input type="text" class="form-control" name="name" id="name" ><br>

    <label for="email">Correo</label><label style="color: #E74C3C;">*</label>
    <input type="email" class="form-control" name="email" id="email"><br>

    <label for="password">Contraseña</label><label style="color: #E74C3C;">*</label>
    <input type="password" class="form-control" name="password" id="password"><br>

    <label for="idPlanta">Planta</label> <label style="color: #E74C3C;">*</label>
    <select class="form-control" name="idPlanta" id="idPlanta">
        <option value="">Selecciona una planta</option>
        @foreach($planta as $value)
            <option value="{{ $value->id }}" {{ (old('noParte') == $value->id ? "selected":"") }}> {{ $value->nombrePlanta }}</option>
        @endforeach
    </select>
    <br>

    <label for="role">Asignar Rol</label> <label style="color: #E74C3C;">*</label>
    <select class="form-control" name="role" id="role">
        <option value="">Selecciona rol</option>
        <option value="admin" >Admin</option>
        <option value="usuario" >Usuario</option>
    </select>
    <br>
    <input type="submit" value="{{$modo}} datos" class="btn btn-success">

    <a href="{{url('empleado')}}" class="btn btn-primary">Regresar</a>

</div>
