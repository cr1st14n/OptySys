@extends('layouts.appSystem')
@section('content')
    <p>que sera esto que se hace</p>
    <div id="morris" style="height: 250px"></div>
    <button class="btn btn-success" onclick="listar()">Ejecutar</button>
@endsection
@section('scrypt')
    <script src="{{asset('AsincronoJS/reportes.js')}}"></script>
@endsection