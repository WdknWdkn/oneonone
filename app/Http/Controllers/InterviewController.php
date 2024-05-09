<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterviewRequest;
use App\Models\Interview;
use App\Models\User;

class InterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::all();
        return view('interviews.index', compact('interviews'));
    }
    
    public function create()
    {
        $users = User::all();
        $interview = new Interview(); // 空のインタビューインスタンスを作成
        return view('interviews.create', compact('users', 'interview'));
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
        return view('interviews.edit', compact('interview', 'users'));
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
