@if(App::environment() != 'production' && !Auth::guest())
    <div class="container-fluid">
        <div class="card" id="debug">
            <div class="card-body">
                <h5>Roles</h5>
                {!! (new Symfony\Component\VarDumper\VarDumper)->dump(\Illuminate\Support\Facades\Auth::user()->roles->toArray()) !!}
                <hr>
                <h5>Session</h5>
                {!! (new Symfony\Component\VarDumper\VarDumper)->dump(Session::all()) !!}
            </div>
        </div>
    </div>
@endif
