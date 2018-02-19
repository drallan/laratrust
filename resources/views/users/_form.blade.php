<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('client_id', 'Client', ['class'=> 'control-label']) !!}
            <div>
                {!! Form::select('client_id', $clients, null, ['class'=> 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
            <div>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
            <div>
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <div>
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="control-label">Password Confirm</label>
            <div>
                {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('Roles', 'Roles:', ['class'=>'control-label']) !!}
    <div class="col-md-6">
        <div class="row">
            @foreach($roles as $id => $role)
                <span class="col-md-6">
				<label>
					{{ Form::checkbox('Roles[]', $id, in_array($id, $currentRoles) ? true : false, ['class' => 'control-checkbox']) }}
                    {{ $role }}
				</label>
				</span>
            @endforeach
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 pull-right">
        <button type="submit" class="btn btn-primary">
            {{ $button }}
        </button>
    </div>
</div>
