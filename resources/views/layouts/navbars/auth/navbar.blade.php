<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/dashboard') }}">{{ \auth()->user()->company?->name }}</a>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" href="{{ route('companies.index') }}">Compañías</a>
          <a class="nav-link" href="{{ route('users.index') }}">Usuarios</a>
        </div>
      </div>
    </div>
  </nav>