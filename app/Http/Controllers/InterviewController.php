<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\User;
use App\Queries\InterviewQuery;
use App\Http\Requests\StoreInterviewRequest;
use Inertia\Inertia;

class InterviewController extends Controller
{
    public function index()
    {
        $users = User::all();
        $interviews = (new InterviewQuery(request()))->apply();
        return Inertia::render('Interviews/Index', ['interviews' => $interviews, 'users' => $users]);
    }

    public function create()
    {
        $users = User::all();
        $interview = new Interview();
        return Inertia::render('Interviews/Create', ['users' => $users, 'interview' => $interview]);
    }

    public function store(StoreInterviewRequest $request)
    {
        $interview = new Interview($request->validated());
        $interview->save();
        return redirect()->route('interviews.index')->with('success', '面談が正常に登録されました。');
    }

    public function edit(string $id)
    {
        $interview = Interview::findOrFail($id);
        $users = User::all();
        return Inertia::render('Interviews/Edit', ['users' => $users, 'interview' => $interview]);
    }

    public function update(StoreInterviewRequest $request, string $id)
    {
        $interview = Interview::findOrFail($id);
        $interview->update($request->validated());
        return redirect()->route('interviews.index')->with('success', '面談情報が更新されました。');
    }

    public function destroy(string $id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete();
        return redirect()->route('interviews.index')->with('success', '面談が削除されました。');
    }
}
