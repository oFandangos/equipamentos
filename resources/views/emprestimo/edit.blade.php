@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash')
        <div class="row">
            

            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Análise</div>
                    <div class="card-body">
                        <br />

                        <form method="POST" action="{{ url('/emprestimo/' . $emprestimo->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('emprestimo.form_analise', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
