<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AccountUserController extends Controller
{
    public function __construct()
    {
        $this->ensureAccountId();
    }

    public function edit(Account $account, User $user)
    {
        $this->authorizeAction($account->id);

        return Inertia::render('Accounts/UserEdit', [
            'user' => $user,
            'roleOptions' => User::roleOptions(),
        ]);
    }

    public function update(Request $request, Account $account, User $user)
    {
        $this->authorizeAction($account->id);

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
}
