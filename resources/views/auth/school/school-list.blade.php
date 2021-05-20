@extends('layouts.admin')

@section('title', 'school-list')

@section('content')
<div id="top-container" class="container-fluid p-0" style="height: 100vh;">
       
  <div class="form-title">
    <h1>スクール一覧</h1>
  </div>

  <div class="row d-flex justify-content-center">

    <div class="col-md-8 col-10">
      @if($schools->isEmpty())
        <p>登録されたスクールがありません</p>
      @else
    </div>

    <div class="review-list col-md-8 col-10">
      @foreach ($schools as $school)
      <a href="{{ url('/schools/' . $school->id) }}" class="list-group-item list-group-item-action">{{ $school->school_name }}</a>
      @endforeach
    </div>
    
    <nav aria-label="Page navigation example">
      {{ $schools->links() }}
    </nav>
    @endif
  </div>
  
</div>
@endsection