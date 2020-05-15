@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<div class="card">
  <div class="card-header"><b>Sistema de Empréstimos de Equipamentos FFLCH - COVID-19</b></div>
  <div class="card-body">

  @auth
    @include('emprestimo.replicado',['codpes'=>Auth::user()->codpes])
  @else
    Ainda não logado(a)
  @endauth
  </div>
</div>

@endsection('content')
