<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AccountUserController extends Controller
{
    public function __construct()
    {
    }

    public function edit(Account $account, User $user)
    {
        $this->ensureAccountId();

        if ($user->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        return Inertia::render('Accounts/UserEdit', [
            'user' => $user,
            'roleOptions' => User::roleOptions(),
        ]);
    }

    public function update(Request $request, Account $account, User $user)
    {
        $this->ensureAccountId();

        if ($user->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'nullable|string|max:255',
            'current_department_id' => 'nullable|integer|exists:user_departments,id',
            'current_position_id' => 'nullable|integer|exists:user_positions,id',
        ]);

        $user->update($request->all());

        return redirect()->route('accounts.show', ['account' => $user->account_id])
                         ->with('success', 'ユーザー情報が更新されました。');
    }

    protected function ensureAccountId()
    {
        if (Auth::user()->account_id === null) {
            return redirect()->route('no-account');
        }
    }
}
