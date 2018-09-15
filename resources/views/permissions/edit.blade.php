@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Edit Permission</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-sm btn-danger" href="{{ route('permissions.index') }}"> Back</a>
                </div>
            </div>
        </div>

        {!! Form::model($permission, ['method' => 'PATCH', 'route' => ['permissions.update', $permission->id]]) !!}

        @include('permissions._form')

        {!! Form::close() !!}
    </div>
@stop
