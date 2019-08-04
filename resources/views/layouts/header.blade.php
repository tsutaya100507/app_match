<header class="header">
  <div class="header__title-area">
    <!-- Branding Image -->
    <a href="{{ url('/') }}">
      <h1 class="header__title">Match</h1>
    </a>
  </div>

  <!-- Right Side Of Navbar -->
  <ul class="header__menu">
    <!-- Authentication Links -->
    @if (Auth::guest())
      <li><a href="{{ route('login') }}">ログイン</a></li>
      <li><a href="{{ route('register') }}">新規登録</a></li>
    @else
      <li>
        <a href="/profile" role="button">
            {{ Auth::user()->name }} さんのマイページへ<span class="caret"></span>
        </a>

        <li>
          <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
              Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
      </li>
    @endif
  </ul>
</header>
