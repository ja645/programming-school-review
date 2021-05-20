@extends('layouts.admin')

@section('title', 'rankings')

@section('content')
<div id="top-container" class="container-fluid p-0" style="height: 100vh;">
       
  <div class="form-title">
    <h1>ランキング一覧</h1>
  </div>

  <div class="row d-flex justify-content-center">

    <div class="ranking col-md-8 col-10">
      <div id="rankings">
        <ranking-Component></ranking-Component>
      </div>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="page-link" href="#">
              <i class="page-chevron fas fa-chevron-right fa-flip-horizontal"></i>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">
              <i class="page-chevron fas fa-chevron-right"></i>
            </a>
          </li>
        </ul>
      </nav>

    </div>
  </div>
</div>
@endsection