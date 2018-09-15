@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Create New Permission</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-sm btn-danger" href="{{ route('permissions.index') }}"> Back</a>
                </div>
            </div>
        </div>

        {!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}

        @include('permissions._form')

        {!! Form::close() !!}
    </div>
@stop
