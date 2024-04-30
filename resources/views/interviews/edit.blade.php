@extends('layouts.app')

@section('content')
<div class="container">
    <h1>面談編集</h1>
    <form action="{{ route('interviews.update', $interview->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- フォームの内容、既存のデータをプリセット -->
    </form>
</div>
@endsection
