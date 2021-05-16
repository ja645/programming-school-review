@extends('layouts.admin')

@section('title', 'myreview')

@section('content')
<div class="container-md">
       
  <div>あなたのいいねしたスクール</div>
  <div class="ranking">

    <div class="ranking-list">
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="total" role="tabpanel" aria-labelledby="total-tab">
          @foreach ($likes as $like)
          <a href="{{ url('/schools/' . $like->school->id) }}" class="list-group-item list-group-item-action">{{ $like->school->school_name }}</a>
          @endforeach
        </div>
      </div>
    </div>

    <nav aria-label="Page navigation example">
        {{ $likes->links() }}
    </nav>
  </div>
</div>
@endsection