@extends('layouts.admin')

@section('title', 'myreview')

@section('content')
       
  <div class="form-title">
    <h1>あなたのいいねしたスクール</h1>
  </div>

  <div class="row d-flex justify-content-center mx-0">
    @if($likes->isEmpty())
      <p class="is-empty">いいねしたスクールがありません</p>
    @else

    <div class="review-list">

      @foreach ($likes as $like)
      <a href="{{ url('/schools/' . $like->school->id) }}" class="list-group-item">{{ $like->school->school_name }}</a>
      @endforeach

    </div>


    {{ $likes->links() }}

  @endif

@endsection