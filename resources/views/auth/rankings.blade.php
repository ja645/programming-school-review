@extends('layouts.admin')

@section('title', 'rankings')

@section('content')
<div id="top-container" class="container-fluid p-0">
       
  <div class="form-title">
    <h1>ランキング一覧</h1>
  </div>

  <div class="row d-flex justify-content-center mx-0 pb-5">

    <div class="ranking col-md-8 col-10">
      <div id="rankings">
        <ranking-Component></ranking-Component>
      </div>
    </div>
  </div>
</div>
@endsection