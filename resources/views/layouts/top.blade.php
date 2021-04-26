@extends('layouts.admin')

@section('title', 'top')

<!-- @push('css')
  <link href="{{ secure_asset('css/top.css') }}" rel="stylesheet">
@endpush -->

@section('content')
<div class="container-fluid p-0">

  <div id="top-screen">
    <div id="gray">
      <div id="navy">
        <div id="white"></div>
      </div>
    </div>
    <h1>HOGE!Hogehoge?Hogehogehogehoge,hogehogefugafuga.</h1>
    <p>hogehogehogehogehogehogehogehogehogehogehogehogehoge.</p>
  </div>

  <!-- 滝状パターン -->
  <div class="row pattern-niagara m-0">
    <div class="col d-flex p-0">
      <div class="feature d-none d-xl-block">hogehogefugafuga</div>
      <div class="column" style="height: 35vw; background-color: #003366;"></div>
      <div class="column" style="height: 30vw; background-color: #CCCCCC;"></div>
      <div class="column" style="height: 20vw; background-color: #003366;"></div>
      <div class="column" style="height: 20vw; background-color: white;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="feature d-none d-xl-block">hogehogefugafuga</div>
      <div class="column" style="height: 15vw; background-color: #003366;"></div>
      <div class="column" style="height: 5vw; background-color: #CCCCCC;"></div>
      <div class="column" style="height: 20vw; background-color: #003366;"></div>
      <div class="column" style="height: 20vw; background-color: white;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="feature d-none d-xl-block">hogehogefugafuga</div>
      <div class="column" style="height: 35vw; background-color: #CCCCCC;"></div>
      <div class="column" style="height: 20vw; background-color: #003366;"></div>
      <div class="column" style="height: 20vw; background-color: white;"></div>
      <div class="column" style="height: 10vw; background-color: #CCCCCC;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="feature d-none d-xl-block">hogehogefugafuga</div>
      <div class="column" style="height: 15vw; background-color: #003366;"></div>
      <div class="column" style="height: 20vw; background-color: #CCCCCC;"></div>
      <div class="column" style="height: 20vw; background-color: white;"></div>
      <div class="column" style="height: 30vw; background-color: #003366;"></div>
    </div>
  </div>

  <!-- レスポンシブ用特徴説明 -->
  <div class="row d-xl-none d-flex">
    <div class="col-md-6 col-12">
      <div>hogehoge</div>
    </div>
    <div class="col-md-6 col-12">
      <div>hogehoge</div>
    </div>
  </div>
  <div class="row d-xl-none d-flex">
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
  <div class="row pattern-niagara m-0">
    <div class="col d-flex p-0">
      <div class="column align-self-end" style="height: 35vw; background-color: #003366;"></div>
      <div class="column align-self-end" style="height: 30vw; background-color: #CCCCCC;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: #003366;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: white;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="column align-self-end" style="height: 15vw; background-color: #003366;"></div>
      <div class="column align-self-end" style="height: 5vw; background-color: #CCCCCC;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: #003366;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: white;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="column align-self-end" style="height: 35vw; background-color: #CCCCCC;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: #003366;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: white;"></div>
      <div class="column align-self-end" style="height: 10vw; background-color: #CCCCCC;"></div>
    </div>
    <div class="col d-flex p-0">
      <div class="column align-self-end" style="height: 15vw; background-color: #003366;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: #CCCCCC;"></div>
      <div class="column align-self-end" style="height: 20vw; background-color: white;"></div>
      <div class="column align-self-end" style="height: 30vw; background-color: #003366;"></div>
    </div>
  </div>

</div>

@endsection