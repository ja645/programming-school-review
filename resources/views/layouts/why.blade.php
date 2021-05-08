@extends('layouts.admin')
@section('title', 'why')

@section('content')
<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit">送信</button>
</form>
@endsection