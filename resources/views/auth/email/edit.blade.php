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

  <div class="logo">
    <a href="/">
      Crawl
    </a>
  </div>

  <div class="form-title">
    <h1>メールアドレス変更</h1>
  </div>

  <form method="POST" action="{{ route('email') }}">
  @if (count($errors) > 0)
    <ul>
      @foreach($errors->all() as $e)
        <li class="error-message">{{ $e }}</li>
      @endforeach
    </ul>
  @endif
  @csrf            
                
    <input type="email" name="new_email" class="feedback-input add-input" value="{{ old('new_email') }}" placeholder="新しいメールアドレス">
                
    <input type="submit" value="変更"/>
  </form>

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