@extends('layouts.admin')

@section('title', 'following-list')

@section('content')
<div class="container-md">
       
  <div>あなたのフォローしたレビュー</div>

  @if($followings->isEmpty())
    <p class="is-empty">フォローしたレビューがありません</p>
  @else

    <div class="ranking">

      <div class="ranking-list">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="total" role="tabpanel" aria-labelledby="total-tab">

              @foreach ($followings as $following)
              <a href="{{ url('/reviews/review/' . $following->review->id) }}" class="list-group-item list-group-item-action">{{ $following->review->title }}</a>
              @endforeach
            
          </div>
        </div>
      </div>

      <nav aria-label="Page navigation example">
          {{ $followings->links() }}
      </nav>
    </div>
  @endif
</div>
@endsection