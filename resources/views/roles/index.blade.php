@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="float-left">
          <h2>Role Management</h2>
        </div>
        <div class="float-right">
          @permission('acl-create')
          <a class="btn btn-sm btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
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
        <th>Permissions</th>
        <th width="280px">Action</th>
      </tr>

      @foreach ($roles as $key => $role)
        <tr>
          <td>{{ $role->id }}</td>
          <td>{{ $role->name }}</td>
          <td>{{ $role->display_name }}</td>
          <td>{{ $role->description }}</td>
          <td>
            @if(!empty($role->permissions))
              @php
                $permissions = $role->permissions->sortBy('display_name');
              @endphp
              @foreach($permissions as $permission)
                <label class="badge-pill badge-info">{{ $permission->display_name }}</label>
              @endforeach
            @endif
          </td>
          <td>
            @permission('acl-manage')
            <a class="btn btn-sm btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style' => 'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
            {!! Form::close() !!}
            @endpermission
          </td>
        </tr>
      @endforeach
    </table>
  </div>
@stop
