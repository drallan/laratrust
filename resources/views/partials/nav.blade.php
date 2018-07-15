<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" href="{{ url('/') }}">
    <img src="/images/laravel.png" style="height: 48px;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
      </li>
      @if (!Auth::guest())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle navbarDropdownMenuLink" id="companyNavLink" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">System</a>
          <ul class="dropdown-menu" aria-labelledby="systemNavLink">
            <li><a class="dropdown-item" href="{{route('clients.index')}}">Clients</a></li>
            <li class="dropdown-submenu">
              <a class="dropdown-item" href="#">Users</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('users.index')}}">Search</a></li>
                <li><a class="dropdown-item" href="{{route('users.create')}}">Create</a></li>

              </ul>
            </li>
            @permission('acl-manage')
            <li class="dropdown-submenu">
              <a class="dropdown-item" href="#">Security</a>
              <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('roles.index')}}">Roles</a></li>
              <li><a class="dropdown-item" href="{{route('permissions.index')}}">Permissions</a></li>
              </ul>
            </li>
            @endpermission
          </ul>
        </li>

      @endif
    </ul>
  </div>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
      @if (Auth::guest())
        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
      @else
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a href="{{ route('logout') }}" class="dropdown-item"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </div>
        </li>
      @endif
    </ul>
  </div>
</nav>
