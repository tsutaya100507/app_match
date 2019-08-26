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
          <a href="/profile" role="button">マイページへ</a>
        <li>
          <a href="/project/create">案件投稿</a>
        </li>

        <li>
          <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
              ログアウト
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
      </li>
    @endif
  </ul>

    <div class="header__menu__wrapper">
        <div id="header__menu__drawer">
            <input id="nav-input" type="checkbox" class="header__menu--unshown">
            <label class="header__menu__open" for="nav-input"><span></span></label>
            <label class="header__menu--unshown" id="nav-close" for="nav-input"></label>
            <div id="nav-content">
                <ul>
                    <li>
                      <a href="/login" class="header__item">ログイン</a>
                    </li>
                    <li>
                      <a href="/register" class="header__item">新規登録</a>
                    </li>
                    <li>
                      <a href="/project/create" class="header__item">案件投稿</a>
                    </li>    
                    <li>
                      <a href="/profile" role="button" class="header__item">マイページへ</a>
                    </li>
                    <li>
                      <a href="/profile/posted-projects" class="header__item">投稿案件一覧</a>
                    </li>
                    <li>
                      <a href="/profile/applied-projects" class="header__item">申し込み案件一覧</a>
                    </li>
                    <li>
                      <a href="/profile/public-messages" class="header__item">メッセージ投稿一覧</a>
                    </li>
                    <li>
                      <a href="/profile/dmrooms" class="header__item">dm一覧</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="header__item">
                              ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                        </form>
                      </li>
                  </ul>
            </div>
        </div>
        </div>


    {{-- <div id="open" class="">
      <a href="#g_menu">
        <span>-</span><br>
        <span>-</span><br>
        <span>-</span>
      </a></div>
    <div id="g_menu">
      <div id="close" class="btn"><a href="#">×</a></div>
    </div> --}}

</header>
