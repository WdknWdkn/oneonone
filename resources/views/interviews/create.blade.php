@extends('layouts.app')

@section('content')
<header class="bg-white shadow w-full">
    <div class="w-full py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">新規面談登録</h2>
    </div>
</header>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <form action="{{ route('interviews.store') }}" method="POST" class="space-y-4">
        @csrf
        <!-- ここに各フォームフィールドを追加します。例えば： -->
        <div class="py-2">
            <label for="interview_date" class="block text-lg font-medium text-gray-700">面談日時</label>
            <input type="date" id="interview_date" name="interview_date" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <!-- その他のフォームフィールドも同様に -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">登録</button>
    </form>
</div>
@endsection
