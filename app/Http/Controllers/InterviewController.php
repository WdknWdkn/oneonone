<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interview; // Interview モデルをインポート

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interviews = Interview::all(); // Interview モデルからすべてのデータを取得
        return view('interviews.index', compact('interviews')); // データをビューに渡す
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('interviews.create'); // 新規登録用のビューを表示
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // バリデーションルールを定義
            'interview_date' => 'required|date',
            'interviewer' => 'required|string|max:255',
            'interviewee' => 'required|string|max:255',
            'content' => 'required|string',
            'note' => 'nullable|string',
        ]);
    
        $interview = new Interview($validated);
        $interview->save();
    
        return redirect()->route('interviews.index')->with('success', '面談が正常に登録されました。');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $interview = Interview::findOrFail($id); // IDに基づいて面談情報を取得
        return view('interviews.edit', compact('interview')); // 編集用のビューを表示、データを渡す
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            // バリデーションルールを定義
            'interview_date' => 'required|date',
            'interviewer' => 'required|string|max:255',
            'interviewee' => 'required|string|max:255',
            'content' => 'required|string',
            'note' => 'nullable|string',
        ]);
    
        $interview = Interview::findOrFail($id);
        $interview->update($validated);
    
        return redirect()->route('interviews.index')->with('success', '面談情報が更新されました。');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete();
    
        return redirect()->route('interviews.index')->with('success', '面談が削除されました。');
    }
}
