@extends('layouts.app')

@section('content')
    @if(count($users))
        <div class="container">
            <div class="card m-3">
                <div class="card-header bg-secondary text-white">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h3>User Management</h3>
                            </div>
                            <div class="pull-right">
                                @permission('user-manage')
                                {!! link_to_route('users.create', 'Create New User', null, ['class' => 'btn btn-sm btn-success']) !!}
                                @endpermission
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-block p-2">
                    <table class="table table-sm table-striped">
                        <thead class="table-inverse">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Client</th>
                            <th>Roles</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->client->name }}</td>
                                <td>
                                    @if(!empty($user->roles))
                                        @php
                                            $roles = $user->roles->sortBy('display_name');
                                        @endphp
                                        @foreach($roles as $role)
                                            <label class="badge-pill badge-success">{{ $role->display_name }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                @permission('user-manage')
                                <td class="btn-group">
                                    {!! link_to_route('users.edit', 'Edit', ['id' => $user->id], ['class' => 'btn btn-sm btn-warning']) !!}
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                                @endpermission
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection
