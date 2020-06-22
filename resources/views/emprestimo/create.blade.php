@extends('layouts.app')

@section('content')
    @include('flash')
    <div class="container">
        <div class="row">

            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Nova Solicitação de Empréstimo</div>
                    <div class="card-body">
                        <br />

                        <form method="POST" action="{{ url('/emprestimo') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('emprestimo.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
