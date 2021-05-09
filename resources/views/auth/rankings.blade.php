@extends('layouts.admin')

@section('title', 'rankings')

@section('content')
<div class="container-md">
       
  <div class="ranking">

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
@endsection