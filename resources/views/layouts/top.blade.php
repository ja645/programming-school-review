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

  <!-- swiper css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.8/swiper-bundle.min.css" integrity="sha512-eeBbzvdY28BPYqEsAv4GU/Mv48zr7l0cI6yhWyqhgRoNG3sr+Q2Fr6751bA04Cw8SGUawtVZlugHm5H1GOU/TQ==" crossorigin="anonymous" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  
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
<div id="top-container" class="container-fluid p-0">
  
  <div id="wrap">
    <div id="gray">
      <div id="white"></div>
      <div class="wave">
        <img src="{{ asset('/images/波.svg') }}" alt="">
      </div>
      <div class="swimmer">
        <img src="{{ asset('/images/swimmer.svg') }}" alt="">
      </div>
      
      <div class="top-text">
        <h1 class="catch">HOGE!Hogehoge?<span class="d-block d-"></span>Hogehogehogeh</h1>
        <p class="sub-title">crawlは、プログラミングスクールのレビューサービスです。</p>
        <p>実際の受講生の正直な評価を知ることが出来ます。</p>
        <p>さらにcrawlでは、レビュー投稿者とチャットでやり取りが出来ます。</p>
        <p>Web上の記事からはわからない詳細や、自分のレベルに合っているかなどいろいろ質問してみましょう！</p>
      </div>
    </div>
  </div>
  

    <div class="top-buttons row m-0">
      <div class="btn-signup col-md-4 col-12 mx-auto">
        <p class="d-none d-sm-inline">さあ、使ってみましょう！</p>
        <button onclick="window.location='{{ route("signup") }}'" type="button" class="btn btn-danger btn-lg">アカウント作成</button>
      </div>
      <div class="btn-login col-md-4 col-12 mx-auto">
        <p class="d-none d-sm-inline">アカウントをお持ちの方は</p>
        <button onclick="window.location='{{ route("login") }}'" type="button" class="btn btn-success btn-lg">ログイン</button>
      </div>
    </div>

    <div style="width: 90%; margin:auto; text-align:center;"> 
      <p class="sub-title">ランキング</p>
      <p>crawlは、寄せられたレビューからプログラミングスクールをランキング化しています。</p>
      <p>正直な受講生の声が反映されるため、</p>
      <a href="{{ route('ranking') }}">ランキングを見てみる</a>
    </div>
    
    <div style="width: 90%; margin:auto; text-align:center;">
      <p class="sub-title">スクール一覧</p>
      <p>crawlで評価出来るプログラミングスクールは20以上あります。</p>
      <p>ここにないスクールが気になるという方は、<a href="{{ route('contact') }}">お問い合わせフォーム</a>からご要望ください。</p>
    </div>


    <!-- Slider main container -->
    <div class="swiper-container mx-auto" style="width: 90%;">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper my-5">
        <!-- Slides -->
        @foreach ($schools as $school)
        <div class="swiper-slide">
          <div class="card mx-auto" style="width: 18rem;">
            <a href="/schools/ . $shool->id" class="card-link">
            <div id="school-card" class="card-body">
              <h1 class="card-title" style="font-size: 20px;">{{ $school->school_name }}</h1>
            </div>
          </a>
          </div>  
        </div>
        @endforeach
      </div>
      
      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>

      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev"><i class="fas fa-chevron-right fa-4x fa-flip-horizontal"></i></div>
      <div class="swiper-button-next"><i class="fas fa-chevron-right fa-4x"></i></div>
    </div>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.8/swiper-bundle.min.js" integrity="sha512-sAHYBRXSgMOV2axInO6rUzuKKM5SkItFLlLHQ8YjRD+FBwowtATOs4njP9oim3/MzyAGrB52SLDjpAOLcOT9TA==" crossorigin="anonymous"></script>
    <script>
      const carouselModule = (() => {
        return {
        configure: () => {
          const mySwiper = new Swiper('.swiper-container', {
            // ここからはオプションを記述していきます
            loop: true,
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
              el: '.swiper-pagination',
            },
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
            breakpoints: {
              1200: {
                slidesPerView: 3,
                spaceBetween: 10,
              },
              768: {
                slidesPerView: 2,
                spaceBetween: 0,
              }
            }
          })
        }
      }
    })()
    
    carouselModule.configure()
    </script>

<!-- 投稿募集 -->
<div class="recruit">
  <p class="sub-title">あなたの体験は貴重な財産です。</p>
  <p>すでにプログラミングスクールを受講された方は、ぜひレビューを書いてみましょう！</p>
  <p>あなたの声を待っている人がたくさんいます！</p>
  <button onclick="window.location='{{ route("signup") }}'" type="button" class="btn btn-danger btn-lg">アカウントを作成してレビューを投稿する</button>
</div>
</div>
<footer class="mt-auto">
  <div class="container-fluid d-flex justify-content-sm-start justify-content-center">
    <a class="footer-logo" href="{{ route('top') }}">ロゴ</a>  
    <a class="ms-5" href="#">サイト概要</a>
    <a class="ms-5" href="{{ route('contact') }}">お問い合わせ</a>
  </div>
</div>
</footer>

<!-- Scripts -->
@if(app('env')=='local')
<script src="{{ mix('js/app.js') }}" defer></script>
@endif
@if(app('env')=='production')
<script src="{{ mix('js/app.js') }}" defer></script>
@endif

<!-- Bootstrap5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>