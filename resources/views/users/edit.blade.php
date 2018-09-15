@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card m-3">
            <div class="card-header bg-warning">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="float-left">
                            <h2>Edit User</h2>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-danger" href="{{ route('users.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'class'=>'form-horizontal']) !!}
                @include('users._form', ['button'=>'Update'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
