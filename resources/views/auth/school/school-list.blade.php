@extends('layouts.admin')

@section('title', 'school-list')

@section('content')
<div class="container-md">
       
  <div>スクール一覧</div>
  <div class="ranking">

    <div class="ranking-list">
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="total" role="tabpanel" aria-labelledby="total-tab">
          @foreach ($schools as $school)
          <a href="{{ url('/schools/' . $school->id) }}" class="list-group-item list-group-item-action">{{ $school->school_name }}</a>
          @endforeach
        </div>
      </div>
    </div>

    <nav aria-label="Page navigation example">
        {{ $schools->links() }}
    </nav>
  </div>
</div>
@endsection