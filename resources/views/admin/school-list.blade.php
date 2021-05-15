@extends('layouts.admin')

@section('title', 'school-list')

@section('content')

@can('idAdmin')
<div class="container-xl">
  <div class="review-list">
    @foreach ($schools as $school)
    <a href="{{ url('/schools/' . $school->id) }}"  class="list-group-item list-group-item-action">{{ $school->school_name }}</a>
    @endforeach
  </div>
</div>
@else
<p>管理者のみ閲覧出来ます。</p>
@endcan

@endsection