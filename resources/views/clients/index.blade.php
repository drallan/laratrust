@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card card-info mt-3">
            <div class="card-header">
                <div class="pull-left">
                    <h2>Client Management</h2>
                </div>
                <div class="float-md-right">
                    @permission('client-manage')
                    <a class="btn btn-sm btn-success" href="{{ route('clients.create') }}">Create New Client</a>
                    @endpermission
                </div>
            </div>
            <div class="card-block p-2">
                <table class="table table-sm table-striped">
                    <thead class="table-inverse">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Fax</th>
                    <th>Cell</th>
                    <th></th>
                    <th></th>
                    </thead>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->fax }}</td>
                            <td>{{ $client->cell }}</td>
                            <td><a class="btn btn-sm btn-info"
                                   href="{{ route('clients.edit',$client->id) }}">Edit</a>
                            </td>
                            <td>
                                @permission('client-manage')
                                {!! Form::open(['method' => 'DELETE', 'route' => ['clients.destroy', $client->id], 'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                {!! Form::close() !!}
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop
