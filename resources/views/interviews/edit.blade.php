@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">面談編集</h1>
    <form action="{{ route('interviews.update', $interview->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <!-- ここに各フォームフィールドを追加します。例えば、既存のデータをプリセットするためのinput -->
        <div>
            <label for="interview_date" class="block text-sm font-medium text-gray-700">面談日時</label>
            <input type="date" id="interview_date" name="interview_date" value="{{ $interview->interview_date }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <!-- その他のフォームフィールドも同様に -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">更新</button>
    </form>
</div>
@endsection
