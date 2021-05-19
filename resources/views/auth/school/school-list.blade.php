@extends('layouts.admin')

@section('title', 'school-list')

@section('content')
<div class="container-md">
       
  <div>スクール一覧</div>
  @if($schools->isEmpty())
    <p>登録されたスクールがありません</p>
  @else
    <div class="review-list">
      @foreach ($schools as $school)
        <a href="{{ url('/schools/' . $school->id) }}" class="list-group-item list-group-item-action">{{ $school->school_name }}</a>
      @endforeach
    </div>

    <nav aria-label="Page navigation example">
        {{ $schools->links() }}
    </nav>
  </div>
  @endif
</div>
@endsection