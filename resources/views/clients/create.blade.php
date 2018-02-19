@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card m-3">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Create Client</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-sm btn-danger" href="{{ route('clients.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                {!! Form::open(['method' => 'POST', 'action' => 'ClientController@store', 'class'=>'form-horizontal']) !!}

                @include('clients._fields', ['button'=>'Add'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
