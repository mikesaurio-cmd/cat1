@extends('layouts.app')
@section('content')
<div class="container">

<form action="{{ url ('/empresas') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('empresas.form',['modo'=>'Crear'])
</form>

</div>
@endsection