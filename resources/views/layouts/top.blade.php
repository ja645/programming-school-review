@extends('layouts.admin')

@section('title', 'top')

<!-- @push('css')
  <link href="{{ secure_asset('css/top.css') }}" rel="stylesheet">
@endpush -->

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


  <!-- カルーセル -->
  <div id="carouselExampleControls" class="carousel slide d-flex justify-content-between" data-bs-ride="carousel">

    <!-- ボタン（前へ） -->
    <div class="prev">
      <div class="dummy"></div>
      <a class="carousel-btn" href="#carouselExampleControls" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-right fa-4x fa-flip-horizontal"></i>
      </a>
      <div class="dummy"></div>
    </div>

    <!-- カルーセル本体 -->
    <div class="carousel-inner mx-auto" style="width: 80vw;">

      <div class="carousel-item active px-5">
        <div class="row">
          <div class="col-xl-4 col-md-6 col-12">
            <div class="card mx-auto" style="width: 18rem;">
              <a href="#" class="card-link">
              <div class="card-body" style="text-align: center;">
                <h1 class="card-title" style="font-size: 20px;">Card title</h5>
              </div>
            </a>
            </div>  
          </div>
          <div class="col-xl-4 col-md-6 d-md-block d-none">
            <div class="card mx-auto" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>  
          </div>
          <div class="col-xl-4 d-xl-block d-none">
            <div class="card mx-auto" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div class="carousel-item px-5">
        <div class="row">
          <div class="col-xl-4 col-md-6 col-12">
            <div class="card mx-auto" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>  
          </div>
          <div class="col-xl-4 col-md-6 d-md-block d-none">
            <div class="card mx-auto" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>  
          </div>
          <div class="col-xl-4 d-xl-block d-none">
            <div class="card mx-auto" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>  
          </div>
        </div>
      </div>

    </div>

    <!-- ボタン（次へ） -->
    <div class="next">
      <div class="dummy"></div>
      <a class="carousel-btn" href="#carouselExampleControls" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right fa-4x"></i>
      </a>
      <div class="dummy"></div>
    </div>
  </div>

  <!-- 投稿募集 -->
  <div class="recruit">
    <h1>あなたの体験を聞きたがっている人がいます。</h1>
    <p>共有することで貴重な</p>
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