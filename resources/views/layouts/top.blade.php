@extends('layouts.admin')

@section('title', 'top')

@section('content')

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
          <h1 class="catch">情報の波に<span class="d-block d-"></span>溺れない。</h1>
          <p class="sub-title">crawlは、プログラミングスクールのレビューサービスです。</p>
          <div class="sub-text">
            <p>いくつものネットサーフィンを続け、疲れ果てていませんか？</p>
            <p>crawlには、プログラミングスクール受講者の正直な評価が寄せられてます。</p>
            <p>投稿者とコメントで会話が出来るため、</p>
            <p>Web上の記事からはわからない詳細や、自分のレベルに合っているかなどいろいろ質問してみましょう！</p>
          </div>
        </div>
      </div>
    </div>

    <div style="color: white; width: 90%; margin: auto; margin-top: 50px; text-align:center;"> 
      <div class="form-title">
        <h1>ランキング</h1>
      </div>
      <p>crawlは、寄せられたレビューからプログラミングスクールをランキング化しています。</p>
      <p>正直な受講生の声が反映されるため、</p>
      <form action="{{ route('ranking') }}" method="get">
        <input type="submit" value="ランキングを見る" style="margin-top: 30px;"/>
      </form>
    </div>
    
    <div style="color: white; width: 90%; margin:auto; margin-top: 50px; text-align:center;">
      <div class="form-title">
        <h1>プログラミングスクール</h1>
      </div>
      <p>crawlで評価出来るプログラミングスクールは20以上あります。</p>
      <p>ここにないスクールが気になるという方は、<a href="{{ route('contact') }}" style="color: darkorange;">お問い合わせフォーム</a>からご要望ください。</p>
      <form action="{{ route('ranking') }}" method="get">
        <input type="submit" value="スクール一覧を見る" style="margin-top: 30px;"/>
      </form>
    </div>


    <!-- Slider main container -->
    <div class="swiper-container mx-auto" style="width: 90%;">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper my-5">
        <!-- Slides -->
        @foreach ($schools as $school)
        <div class="swiper-slide">
          <div class="card slider-card mx-auto" style="width: 18rem;">
            <a href="{{ url('/schools/' . $school->id) }}" class="card-link">
            <div id="school-card" class="card-body">
              <h1 class="card-title" style="font-size: 20px;">{{ $school->school_name }}</h1>
            </div>
          </a>
          </div>  
        </div>
        @endforeach
      </div>
      
      <!-- If we need pagination -->
      <!-- <div class="swiper-pagination"></div> -->

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
    <div class="recruit" style="color: white; margin-top: 70px;">
      <p class="sub-title">あなたの体験は貴重な財産です。</p>
      <p>すでにプログラミングスクールを受講された方は、ぜひレビューを書いてみましょう！</p>
      <p>あなたの声を待っている人がたくさんいます！</p>
      <form action="{{ route('signup') }}" method="get">
        <input type="submit" value="アカウントを作成" style="margin-top: 30px;"/>
      </form>
    </div>
  </div>
@endsection