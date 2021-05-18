@extends('layouts.admin')

@section('title', 'myreview')

@section('content')
<div class="container-md">
       
  <div>あなたの投稿したレビュー</div>

  @if($reviews->isEmpty())
    <p class="is-empty">投稿したレビューはありません</p>
  @else

    <div class="ranking">

      <div class="ranking-list">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="total" role="tabpanel" aria-labelledby="total-tab">

              @foreach ($reviews as $review)
              <a href="{{ url('/reviews/review/' . $review->id) }}" class="list-group-item list-group-item-action">{{ $review->title }}</a>
              @endforeach
            
          </div>
        </div>
      </div>

      <nav aria-label="Page navigation example">
          {{ $reviews->links() }}
      </nav>
    </div>
  @endif
</div>
@endsection