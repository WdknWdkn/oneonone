@extends('layouts.app')

@section('content')
<div class="container">
    <h1>面談一覧</h1>
    <a href="{{ route('interviews.create') }}" class="btn btn-primary">新規登録</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>面談日時</th>
                <th>面談者</th>
                <th>面談対象者</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($interviews as $interview)
            <tr>
                <td>{{ $interview->id }}</td>
                <td>{{ $interview->interview_date }}</td>
                <td>{{ $interview->interviewer_name }}</td>
                <td>{{ $interview->interviewee_name }}</td>
                <td>
                    <a href="{{ route('interviews.edit', $interview->id) }}" class="btn btn-success">編集</a>
                    <form action="{{ route('interviews.destroy', $interview->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection