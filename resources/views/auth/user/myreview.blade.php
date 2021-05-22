@extends('layouts.admin')

@section('title', 'myreview')

@section('content')
<div id="top-container" class="container-fluid p-0">
       
  <div class="form-title">
    <h1>あなたの投稿したレビュー</h1>
  </div>

  <div class="row d-flex justify-content-center mx-0">

    @if($reviews->isEmpty())
      <p class="is-empty">投稿したレビューはありません</p>
    @else
  
    <div class="review-list col-md-8 col-10">
      @foreach ($reviews as $review)
        <a href="{{ url('/reviews/review/' . $review->id) }}" class="list-group-item" style="border-color: #FF5192">{{ $review->title }}</a>
      @endforeach 
    </div>
  
    <nav aria-label="Page navigation example">
        {{ $reviews->links() }}
    </nav>
  
    @endif
  </div>
</div>
@endsection