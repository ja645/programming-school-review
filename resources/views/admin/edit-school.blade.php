@extends('admin.layouts')

@section('title', 'edit-school')

@section('content')
<div id="top-container" class="container-fluid p-0">

    <div name="logo">
        <a href="/">
            ロゴ
        </a>
    </div>

    <div class="form-title">
        <p>スクール編集</p>
    </div>
    
    <form action="/admin/update" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
    <ul>
        @foreach($errors->all() as $e)
        <li class="error-message">{{ $e }}</li>
        @endforeach
    </ul>
    @endif
    @csrf
    
        <input name="school_name" type="text" class="feedback-input" value="{{ old('school_name', $school->school_name) }}" placeholder="スクール名"/>
        <input name="school_url" type="text" class="feedback-input" value="{{ old('school_url', $school->school_url) }}" placeholder="公式ページのURL" />
        @foreach($school->features as $feature)
            <input name="features[]" type="text" class="feedback-input" value="{{ old('features', $feature) }}" placeholder="スクールの特徴" />              
        @endforeach
        <a id="add" type="button" class="feedback-input add-input" onclick="addInput()"><i class="fas fa-plus fa-2x"></i></a>
        <input type="submit" value="編集"/>
    </form>
</div>      
            
<script type="text/javascript">
    function addInput(){
        var add = document.getElementById('add');

        var new_input = document.createElement('input');
        new_input.setAttribute('type', 'text');
        new_input.setAttribute('name', 'features[]');
        new_input.setAttribute('placeholder', 'スクールの特徴を入力してください。');

        add.before(new_input);
    };
</script>
@endsection