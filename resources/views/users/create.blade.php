@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Create User</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-sm btn-danger" href="{{ route('users.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                {!! Form::open(['method' => 'POST', 'action' => 'UserController@store', 'class'=>'form-horizontal']) !!}

                @include('users._form', ['button'=>'Add'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
