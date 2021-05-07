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
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
  </script>
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
  <!-- 個別のcssを読み込む -->
  @stack('css')

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body>

<div class="container-xl">

  <div class="row d-flex justify-content-center">

    <div class="col-md-8">

        <div name="logo">
            <a href="/">
                ロゴ
            </a>
        </div>

        <!-- Session Status -->
        <div class="mb-4" :status="session('status')"></div>

        <!-- Validation Errors -->
        <div class="mb-4" :errors="$errors"></div>

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div id="user-prof" class="card" style="margin: 10.0rem 0;">
            <div class="card-header">ログイン</div>
            <div class="card-body text-secondary">
              <ul class="list-group list-group-flush">
                
                <li class="list-group-item">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" placeholder="メールアドレスを入力してください。">
                </li>
                
                <li class="list-group-item">
                  <label for="password">パスワード</label>
                  @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" style="border-bottom: solid 2px;">
                    パスワードをお忘れですか？
                  </a>
                  @endif
                  <input type="password" name="password" required autocomplete="current-password" placeholder="半角英数字をそれぞれ1字使い、8~100字で入力してください。">
                </li>
            
                <li class="list-group-item">
                  <button type="submit" class="btn btn-success" data-bs-container="body">
                      ログイン
                  </button>
                  <div class="d-flex justify-content-start" style="padding-top: 10px;">
                    <input id="remember_me" type="radio" name="remember" style="width: 30px; margin: auto;"><label for="remember_me">ログイン状態を保存する</label>
                  </div>
                </li>
              </ul>
            </div>
          </div>

        </form>
    </div>
  </div>
</div>

<!-- Scripts -->
@if(app('env')=='local')
  <script src="{{ asset('js/app.js') }}" defer></script>
  @endif
  @if(app('env')=='production')
  <script src="{{ secure_asset('js/app.js') }}" defer></script>
  @endif
  
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>