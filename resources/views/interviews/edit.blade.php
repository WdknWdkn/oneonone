@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <form action="{{ route('interviews.update', $interview->id) }}" method="POST" class="space-y-4">
        @method('PUT')
        @include('interviews.components.form')
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">更新</button>
    </form>
</div>
@endsection
