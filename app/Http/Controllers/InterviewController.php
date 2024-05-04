<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterviewRequest;
use App\Models\Interview;

class InterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::all();
        return view('interviews.index', compact('interviews'));
    }
    
    public function create()
    {
        return view('interviews.create');
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
        return view('interviews.edit', compact('interview'));
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
