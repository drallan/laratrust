<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('partials.nav')

        <main class="py-4">
            <div class="container-fluid">
                @include('vendor.flash.message')
                @include('partials.errors')
            </div>
            @yield('content')
        </main>
    </div>

    @include('partials._debug')

    <script>
        $(document).ready(function () {
            $('.date-picker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('.year-picker').datepicker({
                format: 'yyyy',
                startView: 2,
                viewMode: "years",
                minViewMode: "years"
            });
            $('.onchangeSubmit').change(function() {
                $(this).closest('form').submit();
            });
        });
    </script>

    @stack('scripts')

    <script>
        $('#flash-overlay-modal').modal();
    </script>
</body>
</html>
