<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Scripts -->
  <script src="{{ secure_asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light py-4">
    <div class="container-xl">
      <a class="navbar-brand me-5" href="#">ロゴ</a>

      <!-- 画面幅が小さいときハンバーガーメニュー -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item my-auto">
            <a class="nav-link active" aria-current="page" href="#">ランキングを見る</a>
          </li>
        </ul>
          <form id="s-form" class="d-flex">
            <input id="s-box" class="form-control me-2" type="search" placeholder="キーワードで検索" aria-label="Search">
            <button id="s-btn" type="submit"><i class="fas fa-search fa-lg"></i></button>
          </form>

        <ul class="navbar-nav ms-auto">
          <!-- ログイン後 -->
          @if(Auth::check())
          <li class="nav-item my-auto">
            <a class="nav-link active" aria-current="page" href="#">マイページ</a>
          </li>
          <li class="nav-item my-auto">
            <a class="nav-link active" aria-current="page" href="#">ログアウト</a>
          </li>

          <!-- ログイン前 -->
          @else
          <li class="nav-item my-auto">
            <a class="nav-link active" aria-current="page" href="#">アカウント作成</a>
          </li>
          <li class="nav-item my-auto">
            <a class="nav-link active" aria-current="page" href="#">ログイン</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <main>
    @yield('content')
  </main>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>