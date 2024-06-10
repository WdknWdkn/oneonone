<?php
namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return Inertia::render('Accounts/Index', ['accounts' => $accounts]);
    }

    public function create()
    {
        return Inertia::render('Accounts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Account::create($request->all());

        return redirect()->route('accounts.index')->with('success', '法人が作成されました。');
    }

    public function edit(Account $account)
    {
        return Inertia::render('Accounts/Edit', ['account' => $account]);
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $account->update($request->all());

        return redirect()->route('accounts.index')->with('success', '法人が更新されました。');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')->with('success', '法人が削除されました。');
    }
}
