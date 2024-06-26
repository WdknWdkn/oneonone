<?php

namespace App\Http\Controllers;

use App\Models\UserPosition;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserPositionController extends Controller
{
    public function __construct()
    {
        $this->notEnsureUser();

        $this->ensureAccountId();
    }

    public function index()
    {
        $userPositions = UserPosition::where('account_id', Auth::user()->account_id)->get();
        return Inertia::render('UserPositions/Index', ['userPositions' => $userPositions]);
    }

    public function create()
    {
        return Inertia::render('UserPositions/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        UserPosition::create($request->all() + ['account_id' => Auth::user()->account_id]);

        return redirect()->route('user-positions.index')->with('success', '役職が作成されました。');
    }

    public function edit(UserPosition $userPosition)
    {
        if ($userPosition->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        return Inertia::render('UserPositions/Edit', ['userPosition' => $userPosition]);
    }

    public function update(Request $request, UserPosition $userPosition)
    {
        if ($userPosition->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $userPosition->update($request->all());

        return redirect()->route('user-positions.index')->with('success', '役職が更新されました。');
    }

    public function destroy(UserPosition $userPosition)
    {
        if ($userPosition->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $userPosition->delete();

        return redirect()->route('user-positions.index')->with('success', '役職が削除されました。');
    }
}
