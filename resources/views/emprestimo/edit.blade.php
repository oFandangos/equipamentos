@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            

            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Análise</div>
                    <div class="card-body">
                        <a href="{{ url('/emprestimo') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        <form method="POST" action="{{ url('/emprestimo/' . $emprestimo->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('emprestimo.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
