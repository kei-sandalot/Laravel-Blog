<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">

  <title>@yield('title')</title>

  <link href="{{ asset('css/foundation.min.css') }}" rel="stylesheet" type="text/css" >
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >

  <script src="{{ asset('js/vendor/custom.modernizr.js') }}" type="text/javascript"></script>
</head>
<body>
<div class="row main">
  <div class="small-12 large-12 column" id="masthead">
    <header>
      <nav class="top-bar" data-topbar>
        <ul class="title-area">
          <!-- Title Area -->
          <li class="name"></li>
          <li class="toggle-topbar menu-icon"><a href="#"><span>メニュー</span></a></li>
        </ul>
        <section class="top-bar-section">
          <ul class="left">
            <li class="{{(strcmp(URL::full(), URL::to('/')) == 0) ? 'active' : ''}}"><a href="{{URL::to('/')}}">ホーム</a></li>
          </ul>
          <ul class="right">
            @if(Auth::check())

              <!-- if文の解説：現在ページのliクラスにactiveを付加する -->
              <li class="{{ (strpos(URL::current(), URL::to('admin'))!== false) ? 'active' : '' }}">
                <a href="/admin">ダッシュボード</a>
              </li>
              <li class="{{ (strpos(URL::current(), URL::to('logout'))!== false) ? 'active' : '' }}" >
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
            @else
              <li class="{{ (strpos(URL::current(), URL::to('login'))!== false) ? 'active' : '' }}">
                <a href="/login">ログイン</a>
              </li>
            @endif
          </ul>
        </section>
      </nav>
      <div class="sub-header">
        <hgroup>
          <h1><a href="/">Laravelブログ</a></h1>
          <h2>Laravelでブログ作成</h2>
        </hgroup>
      </div>
    </header>
  </div>
  <div class="row">
    @yield('content')
  </div>
  <div class="row">
    <div class="small-12 large-12 column">
      <footer class="site-footer"></footer>
    </div>
  </div>
</div>
  <script src="{{ asset('js/vendor/jquery.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/foundation.min.js') }}" type="text/javascript"></script>
<script>
  $(document).foundation();
</script>
</body>
</html>
