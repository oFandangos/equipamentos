@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<div class="card">
  <div class="card-header"><b>Sistema de Empréstimos de equipamentos FFLCH - COVID-19</a></div>
  <div class="card-body">

  @auth
      Já logado
  @else
      Não logado
  @endauth
  </div>
</div>

@endsection('content')
