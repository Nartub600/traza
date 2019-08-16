<header>
  <nav class="navbar navbar-top navbar-default" role="navigation">
    <div class="container">
      <div>
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ route('home') }}" aria-label="Argentina.gob.ar Presidencia de la Nación">
            <img alt="Argentina.gob.ar" src="{{ asset('images/argentinagob.svg') }}" height="50">
          </a>
          @guest
          <a href="{{ route('login') }}" class="btn btn-login btn-link visible-xs">Login</a>
          @endguest
          @auth
          <a
            class="btn btn-login btn-link visible-xs"
            href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          >
              Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          @endauth
        </div>
        @guest
        <a href="{{ route('login') }}" class="btn btn-login btn-link hidden-xs">Login</a>
        @endguest
        @auth
        <a
          class="btn btn-login btn-link hidden-xs"
          href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endauth
      </div>
    </div>
  </nav>
</header>
