@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Show Role</h2>
                </div>
                <div class="pull-right">
                    <a class="btn-sm btn-danger" href="{{ route('roles.index') }}"> Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $role->name }}
                    <br>
                    <strong>Display Name:</strong>
                    {{ $role->display_name }}
                    <br>
                    <strong>Description:</strong>
                    {{ $role->description }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    @if(!empty($role->permissions))
                        @php
                            $permissions = $role->permissions->sortBy('display_name');
                        @endphp
                        @foreach($permissions as $permission)
                            <label class="badge-pill badge-success">{{ $permission->display_name }}</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
