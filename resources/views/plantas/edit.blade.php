@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ url ('/plantas/'.$planta->id) }}" method="post">
    @csrf
    {{method_field('PATCH')}}

    @include('plantas.form',['modo'=>'Editar'])

</form>
</div>
@endsection