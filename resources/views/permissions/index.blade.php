@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Permission Management</h2>
                </div>
                <div class="pull-right">
                    @permission('acl-manage')
                    <a class="btn btn-sm btn-success" href="{{ route('permissions.create') }}">Create New Permission</a>
                    @endpermission
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Roles</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->display_name }}</td>
                    <td>{{ $permission->description }}</td>
                    <td>
                        @if(!empty($permission->roles))
                            @php
                                $roles = $permission->roles->sortBy('display_name');
                            @endphp
                            @foreach($roles as $role)
                                <label class="badge-pill badge-warning">{{ $role->display_name }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('permissions.show',$permission->id) }}">Show</a>
                        @permission('acl-update')
                        <a class="btn btn-sm btn-primary" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id], 'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                        {!! Form::close() !!}
                        @endpermission
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $permissions->render() !!}
    </div>
@stop
