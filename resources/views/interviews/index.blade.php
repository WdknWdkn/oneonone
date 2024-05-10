@extends('layouts.app')

@section('content')
<header class="bg-white shadow w-full">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-xl font-semibold text-gray-800">面談一覧</h1>
    </div>
</header>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <button onclick="toggleForm()" class="mt-4 mb-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">検索を開く</button>

    <div id="searchForm" style="display: none;" class="bg-white p-4 shadow rounded-md">
        <form action="{{ route('interviews.index') }}" method="GET">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">

                <!-- 面談者IDのセレクトボックス -->
                <div>
                    <label for="interviewer_id" class="block text-sm font-medium text-gray-700">面談者ID:</label>
                    <select id="interviewer_id" name="interviewer_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="">選択してください</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ (request('interviewer_id') == $user->id) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 被面談者IDのセレクトボックス -->
                <div>
                    <label for="interviewee_id" class="block text-sm font-medium text-gray-700">被面談者ID:</label>
                    <select id="interviewee_id" name="interviewee_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="">選択してください</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ (request('interviewee_id') == $user->id) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700">面談日From:</label>
                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700">面談日To:</label>
                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400">検索</button>
            </div>
        </form>
    </div>

    <div class="py-6">
        <div class="py-4">
            <a href="{{ route('interviews.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">新規登録</a>
        </div>
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">面談日時</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">面談者</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">面談対象者</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($interviews as $interview)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $interview->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $interview->interview_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $interview->interviewer_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $interview->interviewee_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('interviews.edit', $interview->id) }}" class="text-indigo-600 hover:text-indigo-900">編集</a>
                            <form action="{{ route('interviews.destroy', $interview->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody
                </table>
        </div>
    </div>
</div>
@endsection

<script>
function toggleForm() {
    var form = document.getElementById('searchForm');
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}
</script>
