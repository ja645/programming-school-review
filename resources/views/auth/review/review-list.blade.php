@extends('layouts.admin')

@section('title', 'review-list')

@section('content')
       
  <div class="form-title">
    <h1>{{ $reviews->first()->school->school_name }}に寄せられたレビュー</h1>
  </div>
  
  <div class="row d-flex justify-content-center mx-0">
    <div class="col-md-8 col-10">
      @if($reviews->isEmpty())
        <p class="is-empty">{{ $reviews->first()->school->school_name }}に寄せられたレビューはありません</p>
      @else
    </div>

    <div class="review-list col-md-8 col-10">
      @foreach ($reviews as $review)
      <a href="{{ url('/review/' . $review->id) }}" class="list-group-item list-group-item-action">{{ $review->title }}</a>
      @endforeach
    </div>
 
    {{ $reviews->links() }}

    @endif
  </div>

@endsection