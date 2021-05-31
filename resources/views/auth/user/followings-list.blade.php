@extends('layouts.admin')

@section('title', 'following-list')

@section('content')

  <div class="form-title">
    <h1>あなたのフォローしたレビュー</h1>
  </div>

  <div class="row d-flex justify-content-center mx-0">

    @if($followings->isEmpty())
      <p class="is-empty">フォローしたレビューがありません</p>
    @else

    <div class="review-list">
    
      @foreach ($followings as $following)
      <a href="{{ url('/reviews/review/' . $following->review->id) }}" class="list-group-item" style="border-color: #FF5192">{{ $following->review->title }}</a>
      @endforeach
          
    </div>

    {{ $followings->links() }}
    
  @endif

@endsection