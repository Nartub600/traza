<header>
  <nav class="navbar navbar-top navbar-default" role="navigation">
    <div class="container">
      <div class="flex justify-between items-center">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ route('home') }}" aria-label="Argentina.gob.ar Presidencia de la Nación">
            <img alt="Argentina.gob.ar" src="{{ asset('images/argentinagob.svg') }}" height="50">
          </a>
          @guest
          <a href="{{ route('login') }}" class="btn btn-login btn-link visible-xs m-0">Login</a>
          @endguest
          @auth
          <a
            class="btn btn-login btn-link visible-xs"
            href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          >
              Logout
          </a>
          @endauth
        </div>
        @guest
        <a href="{{ route('login') }}" class="btn btn-login btn-link hidden-xs m-0">Login</a>
        @endguest
        @auth
        <div class="flex items-center -mx-2">
          @can('listar trazas')
          <a href="{{ route('trazas.index') }}" class="text-celeste uppercase no-underline font-black mr-8">
            Trazas
          </a>
          @endcan

          @can('listar licencias')
          <a href="{{ route('licencias.index') }}" class="text-celeste uppercase no-underline font-black mr-8">
            Licencias
          </a>
          @endcan

          @canany(['listar usuarios', 'listar perfiles', 'listar grupos', 'listar productos', 'listar lcm', 'listar ncm'])
          <div class="dropdown">
            <button class="bg-white text-celeste mr-8 p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-cog fa-2x"></i>
            </button>
            <ul class="dropdown-menu p-1 right-0" style="left: unset;">
              @can('listar usuarios')<li class="uppercase mb-1"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>@endcan
              @can('listar perfiles')<li class="uppercase my-1"><a href="{{ route('perfiles.index') }}">Perfiles</a></li>@endcan
              @can('listar grupos')<li class="uppercase my-1"><a href="{{ route('grupos.index') }}">Grupos de usuarios</a></li>@endcan
              @can('listar productos')<li class="uppercase my-1"><a href="{{ route('productos.index') }}">Productos (Categorías)</a></li>@endcan
              @can('listar lcms')<li class="uppercase mt-1"><a href="{{ route('lcms.index') }}">LCMs</a></li>@endcan
              @can('listar ncm')<li class="uppercase mt-1"><a href="{{ route('ncm.index') }}">NCM</a></li>@endcan
            </ul>
          </div>
          @endcanany

          <div class="dropdown">
            <button class="bg-white text-celeste p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-circle fa-2x"></i>
            </button>
            <ul class="dropdown-menu p-1 right-0" style="left: unset;">
              <li class="uppercase mb-1"><a href="{{ route('perfil.index') }}">Perfil</a></li>
              <li class="uppercase my-1"><a href="{{ route('cambiarpassword.index') }}">Cambiar contraseña</a></li>
              <li class="uppercase mt-1">
                <a
                  href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                    Logout
                </a>
              </li>
            </ul>
          </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endauth
      </div>
    </div>
  </nav>
</header>
