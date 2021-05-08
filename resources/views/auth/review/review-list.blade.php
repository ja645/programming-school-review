@extends('layouts.admin')

@section('title', 'review-list')

@section('content')
<div class="container-md">
       
  <div>{{ $school_name }}に寄せられたレビュー</div>
  <div class="ranking">

    <div class="ranking-order d-flex justify-content-end">
      <label for="並べ替え">並べ替え：</label>
      <select class="form-select" aria-label="並べ替え">
        <option selected @click="changeToggle()">新しい順</option>
        <option value="1" @click="changeToggle()">古い順</option>
      </select>
    </div>

    <div class="ranking-list">

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="total-tab" data-bs-toggle="tab" href="#review" role="tab" aria-controls="total" aria-selected="true">投稿日</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="total" role="tabpanel" aria-labelledby="total-tab">
          @foreach ($reviews as $review)
          <a href="{{ url('/review/' . $review->id) }}" class="list-group-item list-group-item-action">{{ $review->title }}</a>
          @endforeach
        </div>
      </div>
    </div>

    <nav aria-label="Page navigation example">
        {{ $reviews->links() }}
    </nav>
  </div>
</div>
@endsection