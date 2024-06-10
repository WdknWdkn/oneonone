<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\TemplateItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    /**
     * 質問テンプレート一覧画面
     */
    public function index()
    {
        $this->ensureAccountId();

        $templates = Template::where('account_id', Auth::user()->account_id)->with('templateItems')->get();
        return Inertia::render('Templates/Index', ['templates' => $templates]);
    }

    /**
     * 質問テンプレート新規作成画面
     */
    public function create()
    {
        $this->ensureAccountId();

        return Inertia::render('Templates/Create', ['question_types' => TemplateItem::questionTypes()]);
    }
    
    /**
     * 質問テンプレート編集画面
     */    
    public function edit(Template $template)
    {
        $this->ensureAccountId();

        $template->load('templateItems');
        return Inertia::render('Templates/Edit', [
            'template' => $template,
            'question_types' => TemplateItem::questionTypes()
        ]);
    }
    
    /**
     * 質問テンプレート新規登録処理
     */
    public function store(Request $request)
    {
        $this->ensureAccountId();

        // バリデーション
        $validatedData = $request->validate([
            'template_name' => 'required|string|max:255',
            'template_items.*.question_text' => 'required|string',
            'template_items.*.question_type' => 'required|string|in:' . implode(',', array_column(TemplateItem::questionTypes(), 'value')),
        ]);

        // テンプレートを作成
        $template = Template::create([
            'template_name' => $validatedData['template_name'], 
            'account_id' => Auth::user()->account_id
        ]);

        // テンプレートに質問を追加
        foreach ($validatedData['template_items'] as $item) {
            $template->templateItems()->create($item);
        }
        return redirect()->route('templates.index');
    }

    /**
     * 質問テンプレート更新処理
     */
    public function update(Request $request, Template $template)
    {
        $this->ensureAccountId();

        // バリデーション
        $validatedData = $request->validate([
            'template_name' => 'required|string|max:255',
            'template_items.*.question_text' => 'required|string',
            'template_items.*.question_type' => 'required|string|in:' . implode(',', array_column(TemplateItem::questionTypes(), 'value')),
        ]);

        $template->update(['template_name' => $validatedData['template_name']]);

        $template->templateItems()->delete();
        foreach ($validatedData['template_items'] as $item) {
            $template->templateItems()->create($item);
        }
        return redirect()->route('templates.index');
    }

    /**
     * 質問テンプレート削除処理
     */
    public function destroy(Template $template)
    {
        $this->ensureAccountId();

        $template->delete();
        return redirect()->route('templates.index');
    }
}
