@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ url ('/nopartes/'.$nopartes->id) }}" method="post">
    @csrf
    {{method_field('PATCH')}}

    @include('nopartes.form',['modo'=>'Editar'])

</form>
</div>
@endsection