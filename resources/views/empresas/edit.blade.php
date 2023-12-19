@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ url ('/empresas/'.$empresa->id) }}" method="post">
    @csrf
    {{method_field('PATCH')}}

    @include('empresas.form',['modo'=>'Editar'])

</form>
</div>
@endsection