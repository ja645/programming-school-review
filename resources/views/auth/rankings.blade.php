@extends('layouts.admin')

@section('title', 'rankings')

@section('content')
<div class="container-md">
       
  <div class="ranking">

    <div id="app2">
      <ranking-Component></ranking-Component>
    </div>

    <!-- <div class="ranking-list">

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="total-tab" data-bs-toggle="tab" href="#review" role="tab" aria-controls="total" aria-selected="true">総合評価</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">料金</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">カリキュラム</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="total" role="tabpanel" aria-labelledby="total-tab">
          @foreach ($arr_schools as $key => $value)
          <a href="#" class="list-group-item list-group-item-action">{{ $key }}</a>
          @endforeach
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"></div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
      </div>
    </div> -->

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
@endsection