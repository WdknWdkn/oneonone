@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新規面談登録</h1>
    <form action="{{ route('interviews.store') }}" method="POST">
        @csrf
        <!-- フォームの内容 -->
    </form>
</div>
@endsection
