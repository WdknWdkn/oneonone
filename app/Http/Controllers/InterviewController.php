<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\User;
use App\Models\Template;
use App\Http\Requests\StoreInterviewRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    public function index()
    {
        $this->ensureAccountId();

        $users = User::where('account_id', Auth::user()->account_id)->get();
        return Inertia::render('Interviews/Index', ['users' => $users]);
    }

    public function create()
    {
        $this->ensureAccountId();

        $users = User::where('account_id', Auth::user()->account_id)->get();
        $interview = new Interview();
        return Inertia::render('Interviews/Create', ['users' => $users, 'interview' => $interview]);
    }

    public function store(StoreInterviewRequest $request)
    {
        $this->ensureAccountId();

        $interview = new Interview($request->validated());
        $interview->account_id = Auth::user()->account_id;
        $interview->save();

        return redirect()->route('interviews.index')->with('success', '面談が正常に登録されました。');
    }

    public function edit(string $id)
    {
        $this->ensureAccountId();

        $interview = Interview::where('account_id', Auth::user()->account_id)->findOrFail($id);
        $users = User::where('account_id', Auth::user()->account_id)->get();
        return Inertia::render('Interviews/Edit', ['users' => $users, 'interview' => $interview]);
    }

    public function update(StoreInterviewRequest $request, string $id)
    {
        $this->ensureAccountId();

        $interview = Interview::where('account_id', Auth::user()->account_id)->findOrFail($id);
        $interview->update($request->validated());

        return redirect()->route('interviews.index')->with('success', '面談情報が更新されました。');
    }

    public function show(string $id)
    {
        $this->ensureAccountId();

        $interview = Interview::with([
            'interviewer',
            'interviewee',
            'interviewTemplates.template.templateItems',
            'interviewAnswers.templateItem'
        ])->where('account_id', Auth::user()->account_id)->findOrFail($id);
        
        $templates = Template::where('account_id', Auth::user()->account_id)->with('templateItems')->get();

        return Inertia::render('Interviews/Detail', [
            'interview' => $interview,
            'templates' => $templates
        ]);
    }
}
