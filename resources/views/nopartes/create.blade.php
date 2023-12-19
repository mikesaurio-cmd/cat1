@extends('layouts.app')
@section('content')
<div class="container">

<form action="{{ url ('/nopartes') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('nopartes.form',['modo'=>'Crear'])
</form>

</div>
@endsection