<div class="row">
    <div class="col-md-6">
        <div class="form-group m-2">
            {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
            <div>
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group m-2">
            {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
            <div>
                {!! Form::text('email', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group m-2">
            {!! Form::label('address', 'Address', ['class'=>'control-label']) !!}
            <div>
                {!! Form::text('address', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group m-2">
            {!! Form::label('city', 'City', ['class'=>'control-label']) !!}
            <div>
                {!! Form::text('city', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group m-2">
            {!! Form::label('postal_code', 'Postal Code', ['class'=>'control-label']) !!}
            <div>
                {!! Form::text('postal_code', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group m-2">
            {!! Form::label('phone', 'Phone', ['class'=>'control-label']) !!}
            <div>
                {!! Form::text('phone', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group m-2">
            {!! Form::label('cell', 'Cellphone', ['class'=>'control-label']) !!}
            <div>
                {!! Form::text('cell', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group m-2">
            {!! Form::label('fax', 'Fax', ['class'=>'control-label']) !!}
            <div>
                {!! Form::text('fax', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group m-2">
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">
                    {{ $button }}
                </button>
            </div>
        </div>
    </div>
</div>