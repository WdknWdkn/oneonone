<?php
namespace App\Http\Controllers;

use App\Models\UserPosition;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserPositionController extends Controller
{
    public function index()
    {
        $userPositions = UserPosition::all();
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

        UserPosition::create($request->all());

        return redirect()->route('user-positions.index')->with('success', '役職が作成されました。');
    }

    public function edit(UserPosition $userPosition)
    {
        return Inertia::render('UserPositions/Edit', ['userPosition' => $userPosition]);
    }

    public function update(Request $request, UserPosition $userPosition)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $userPosition->update($request->all());

        return redirect()->route('user-positions.index')->with('success', '役職が更新されました。');
    }

    public function destroy(UserPosition $userPosition)
    {
        $userPosition->delete();

        return redirect()->route('user-positions.index')->with('success', '役職が削除されました。');
    }
}
