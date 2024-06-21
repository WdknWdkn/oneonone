<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->notEnsureUser();
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'manager') {
            $accounts = Account::where('id', $user->account_id)->get();
        } elseif ($user->role === 'admin') {
            $accounts = Account::all();
        } else {
            abort(403, 'Unauthorized action.');
        }

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
        $this->authorizeAction($account->id);

        return Inertia::render('Accounts/Edit', ['account' => $account]);
    }

    public function update(Request $request, Account $account)
    {
        $this->authorizeAction($account->id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $account->update($request->all());

        return redirect()->route('accounts.index')->with('success', '法人が更新されました。');
    }

    public function destroy(Account $account)
    {
        $this->authorizeAction($account->id);

        $account->delete();

        return redirect()->route('accounts.index')->with('success', '法人が削除されました。');
    }

    public function show(Account $account)
    {
        $this->authorizeAction($account->id);

        $users = User::where('account_id', $account->id)->get()->map(function($user) {
            $user->role_label = User::getRoleLabel($user->role);
            return $user;
        });

        $unlinkedUsers = User::whereNull('account_id')->get();

        return Inertia::render('Accounts/Detail', [
            'account' => $account,
            'users' => $users,
            'unlinkedUsers' => $unlinkedUsers,
        ]);
    }

    public function linkUser(Request $request, Account $account)
    {
        $this->authorizeAction($account->id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $user->account_id = $account->id;
        $user->save();

        return redirect()->route('accounts.show', ['account' => $account->id])
                         ->with('success', 'ユーザーがアカウントに紐付けられました。');
    }
}
