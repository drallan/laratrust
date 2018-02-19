@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Show Permission</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-sm btn-danger" href="{{ route('permissions.index') }}"> Back</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $permission->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Display Name:</strong>
                    {{ $permission->display_name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ $permission->description }}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions:</strong>
                @if(!empty($permission->roles))
                    @php
                        $roles = $permission->roles->sortBy('display_name');
                    @endphp
                    @foreach($roles as $role)
                        <label class="badge-pill badge-success">{{ $role->display_name }}</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@stop
