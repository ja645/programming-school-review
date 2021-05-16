@extends('layouts.admin')

@section('title', 'top')

@section('content')
<div class="container-fluid p-0">
  
  <div id="top-screen">
  
    <div id="navy">
      <div id="white"></div>
    </div>
    
    <div class="top-text">
      <h1 class="catch">HOGE!Hogehoge?<span class="d-block d-"></span>Hogehogehogeh</h1>
      <p class="sub-text">hogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehoge</p>
    </div>
    <img class="canoe" src="{{ asset('/images/カヌー.svg') }}" alt="">
    <img class="paddle" src="{{ asset('/images/パドル.svg') }}" alt="">

    <div class="top-buttons">
      <div class="btn-signup">
        <p class="d-none d-sm-inline">さあ、使ってみましょう！</p>
        <button onclick="window.location='{{ route("signup") }}'" type="button" class="btn btn-danger btn-lg">アカウント作成</button>
      </div>
      <div class="btn-login">
        <p class="d-none d-sm-inline">アカウントをお持ちの方は</p>
        <button onclick="window.location='{{ route("login") }}'" type="button" class="btn btn-success btn-lg">ログイン</button>
      </div>
    </div>

  </div>

  <!-- 滝状パターン -->
  <div class="row pattern-niagara m-0">
    <div class="col d-flex p-0">
      <div class="feature d-none d-xl-block">hogehogefugafuga</div>
      <div class="column" style="height: 30vw; background-color: #003366;"></div>
      <div class="column No2" style="height: 25vw; background-color: #CCCCCC;"></div>
      <div class="column" style="height: 15vw; background-color: #003366;"></div>
      <div class="column No4" style="height: 20vw; background-color: white;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="feature d-none d-xl-block">hogehogefugafuga</div>
      <div class="column" style="height: 10vw; background-color: #003366;"></div>
      <div class="column No6" style="height: 20vw; background-color: #CCCCCC;"></div>
      <div class="column" style="height: 20vw; background-color: #003366;"></div>
      <div class="column No8" style="height: 20vw; background-color: #CCCCCC;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="feature d-none d-xl-block">hogehogefugafuga</div>
      <div class="column No9" style="height: 15vw; background-color: #003366;"></div>
      <div class="column No10" style="height: 20vw; background-color: white;"></div>
      <div class="column No11" style="height: 10vw; background-color: #003366;"></div>
      <div class="column No12" style="height: 30vw; background-color: #CCCCCC;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="feature d-none d-xl-block">hogehogefugafuga</div>
      <div class="column" style="height: 15vw; background-color: #003366;"></div>
      <div class="column No14" style="height: 20vw; background-color: white;"></div>
      <div class="column No15" style="height: 20vw; background-color: #CCCCCC;"></div>
      <div class="column" style="height: 15vw; background-color: #003366;"></div>
    </div>
  </div>

  <!-- レスポンシブ用特徴説明 -->
  <div class="row d-xl-none d-flex m-0">
    <div class="col-md-6 col-12">
      <div>hogehoge</div>
    </div>
    <div class="col-md-6 col-12">
      <div>hogehoge</div>
    </div>
  </div>
  <div class="row d-xl-none d-flex m-0">
    <div class="col-md-6 col-12">
      <div>hogehoge</div>
    </div>
    <div class="col-md-6 col-12">
      <div>hogehoge</div>
    </div>
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
    <h1>あなたの体験で人がいます。</h1>
    <p>貴重な</p>
    <button onclick="window.location='{{ route("signup") }}'" type="button" class="btn btn-danger btn-lg">アカウントを作成してレビューを投稿する</button>
  </div>
  <div class="row pattern-niagara-bottom m-0">
    <div class="col d-flex p-0">
      <div class="column align-self-end" style="height: 35vw; background-color: #003366;"></div>
      <div class="column align-self-end" style="height: 30vw; background-color: #CCCCCC;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: #003366;"></div>
      <div class="column No20 align-self-end" style="height: 20vw; background-color: white;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="column align-self-end" style="height: 15vw; background-color: #003366;"></div>
      <div class="column align-self-end" style="height: 5vw; background-color: #CCCCCC;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: #003366;"></div>
      <div class="column No24 align-self-end" style="height: 20vw; background-color: white;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="column align-self-end" style="height: 35vw; background-color: #CCCCCC;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: #003366;"></div>
      <div class="column No26 align-self-end" style="height: 20vw; background-color: white;"></div>
      <div class="column align-self-end" style="height: 10vw; background-color: #CCCCCC;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="column align-self-end" style="height: 15vw; background-color: #003366;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: #CCCCCC;"></div>
      <div class="column No30 align-self-end" style="height: 20vw; background-color: white;"></div>
      <div class="column align-self-end" style="height: 30vw; background-color: #003366;"></div>
    </div>
  </div>

</div>
@endsection