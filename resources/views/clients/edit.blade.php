@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="card m-3">
        <div class="card-header bg-info">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Client</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-danger" href="{{ route('clients.index') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            {!! Form::model($client, ['method' => 'PATCH', 'route' => ['clients.update', $client->id], 'class'=>'form-horizontal']) !!}
            @include('clients._fields', ['button'=>'Update'])
            {!! Form::close() !!}
        </div>
    </div>
    <div
@endsection
