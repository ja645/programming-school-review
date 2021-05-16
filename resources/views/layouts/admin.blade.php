<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  
  <!-- swiper css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.8/swiper-bundle.min.css" integrity="sha512-eeBbzvdY28BPYqEsAv4GU/Mv48zr7l0cI6yhWyqhgRoNG3sr+Q2Fr6751bA04Cw8SGUawtVZlugHm5H1GOU/TQ==" crossorigin="anonymous" />

  <!-- Styles -->
  <!-- ローカルではsecure_assetを使わない -->
  @if(app('env')=='local')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
  @endif
  @if(app('env')=='production')
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
  @endif


</head>
<body>

  <nav class="navbar navbar-expand-lg py-3">
    <div class="container-xl">
      <a class="navbar-brand me-5" href="{{ route('top') }}">ロゴ</a>
      
      <!-- 画面幅lg以下で表示される -->
      <form id="s-form" class="d-flex d-lg-none">
        <input id="s-box" class="form-control me-2" placeholder="キーワードで検索" aria-label="Search">
        <button id="s-btn" type="submit"><i class="fas fa-search fa-lg"></i></button>
      </form>

      <!-- 画面幅が小さいときハンバーガーメニュー -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars fa-3x"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item my-auto">
            <div class="nav-icon">
              <a href="{{ route('ranking') }}"><i class="fas fa-crown fa-2x"></i><span>ランキング</span></a>
            </div>
          </li>
        </ul>
          <!-- 画面幅xl以上で表示される -->
          <form id="s-form" class="d-flex d-lg-block d-none ms-lg-5">
            <input id="s-box" class="form-control me-2" placeholder="キーワードで検索" aria-label="Search">
            <button id="s-btn" type="submit"><i class="fas fa-search fa-lg"></i></button>
          </form>

        <ul class="navbar-nav ms-auto">
          <!-- ログイン後 -->
          @if (Auth::check())
          <li class="nav-item my-auto">
            <div class="nav-icon">
              <a href="{{ route('mypage') }}"><i class="fas fa-user fa-2x"></i><span>マイページ</span></a>
            </div>
          </li>
          <li class="nav-item my-auto">
            <div class="nav-icon">
              <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-door-open fa-2x"></i>
                <span>ログアウト</span>
              </a>
              <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
              </form>
            </div>
          </li>

          <!-- ログイン前 -->
          @else
          <li class="nav-item my-auto">
            <div class="nav-icon d-lg-block d-inline">
              <a href="{{ route('signup') }}"><i class="fas fa-user-plus fa-2x"></i><span>新規登録</span></a>
            </div>
          </li>
          <li class="nav-item my-auto">
            <div class="nav-icon">
              <a href="{{ route('login') }}"><i class="fas fa-door-open fa-2x fa-flip-horizontal"></i><span>ログイン</span></a>
            </div>
          </li>
          @endif
        </ul>

      </div>
    </div>
  </nav>

  <!-- フラッシュメッセージ -->
  @if (session('flash_message'))
    <div class="flash_message">
      {{ session('flash_message') }}
    </div>
  @endif
  <main>
    @yield('content')
  </main>

  <footer class="mt-auto">
    <div class="container-fluid d-flex justify-content-sm-start justify-content-center">
      <a class="footer-logo" href="{{ route('top') }}">ロゴ</a>  
      <a class="ms-5" href="#">サイト概要</a>
      <a class="ms-5" href="#">お問い合わせ</a>
    </div>
  </footer>
  
  <!-- Scripts -->
    @if(app('env')=='local')
      <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
    @if(app('env')=='production')
      <script src="{{ secure_asset('js/app.js') }}" defer></script>
    @endif
</body>
</html>