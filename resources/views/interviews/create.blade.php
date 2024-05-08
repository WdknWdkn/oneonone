@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <form action="{{ route('interviews.store') }}" method="POST" class="space-y-4">
        @include('interviews.components.form')
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">登録</button>
    </form>
</div>
@endsection
