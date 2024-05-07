@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">面談編集</h1>
    <form action="{{ route('interviews.update', $interview->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <!-- 面談日 -->
        <div class="py-2">
            <label for="interview_date" class="block text-lg font-medium text-gray-700">面談日</label>
            <input type="date" id="interview_date" name="interview_date"
                value="{{ old('interview_date', format_date($interview->interview_date, 'Y-m-d')) }}"
                required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <!-- 面談者名 -->
        <div class="py-2">
            <label for="interviewer_name" class="block text-lg font-medium text-gray-700">面談者名</label>
            <input type="text" id="interviewer_name" name="interviewer_name"
                value="{{ old('interviewer_name', $interview->interviewer_name) }}"
                required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <!-- 面談者ID -->
        <div class="py-2">
            <label for="interviewer_id" class="block text-lg font-medium text-gray-700">面談者ID</label>
            <select id="interviewer_id" name="interviewer_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">選択してください</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('interviewer_id', $interview->interviewer_id ?? '') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- 面談対象者名 -->
        <div class="py-2">
            <label for="interviewee_name" class="block text-lg font-medium text-gray-700">被面談者名</label>
            <input type="text" id="interviewee_name" name="interviewee_name"
                value="{{ old('interviewee_name', $interview->interviewee_name) }}"
                required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <!-- 面談対象者ID -->
        <div class="py-2">
            <label for="interviewee_id" class="block text lg font-medium text-gray-700">被面談者名ID</label>
            <select id="interviewee_id" name="interviewee_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">選択してください</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('interviewee_id', $interview->interviewee_id ?? '') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>
        <!-- 面談内容 -->
        <div class="py-2">
            <label for="interview_content" class="block text-lg font-medium text-gray-700">面談内容</label>
            <textarea id="interview_content" name="interview_content"
                required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('interview_content', $interview->interview_content) }}</textarea>   
        </div>
        <!-- 備考 -->
        <div class="py-2">
            <label for="notes" class="block text-lg font-medium text-gray-700">備考</label>
            <textarea id="notes" name="notes"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('notes', $interview->notes) }}</textarea>
        </div>
        <!-- 登録ボタン -->
        <div class="py-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">更新</button>
        </div>
        <!-- その他のフォームフィールドも同様に -->
    </form>
</div>
@endsection
