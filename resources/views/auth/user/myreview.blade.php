@extends('layouts.admin')

@section('title', 'myreview')

@section('content')
       
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

      <!-- ページネーション -->
      {{ $reviews->links() }}
  
    @endif
  </div>

@endsection