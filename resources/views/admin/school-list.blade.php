@extends('admin.layouts')

@section('title', 'school-list')

@section('content')
<div class="container-xl">
  <div class="review-list">
    @foreach ($schools as $school)
    <a href="{{ url('/schools/' . $school->id) }}"  class="list-group-item list-group-item-action">
      {{ $school->school_name }}
      <a href="/admin/edit">編集</a>
      <form id="admin-delete" action="'/admin/delete" method="post">
        @csrf
        <a href="/admin/delete" onclick="event.preventDefault(); document.getElementById('admin-delete').submit();">削除</a>
      </form>
    </a>
    @endforeach
  </div>
</div>

@endsection