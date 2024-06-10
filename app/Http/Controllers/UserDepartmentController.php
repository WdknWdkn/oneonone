<?php

namespace App\Http\Controllers;

use App\Models\UserDepartment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserDepartmentController extends Controller
{
    public function index()
    {
        $this->ensureAccountId();

        $userDepartments = UserDepartment::where('account_id', Auth::user()->account_id)->get();
        return Inertia::render('UserDepartments/Index', ['userDepartments' => $userDepartments]);
    }

    public function create()
    {
        $this->ensureAccountId();

        return Inertia::render('UserDepartments/Create');
    }

    public function store(Request $request)
    {
        $this->ensureAccountId();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        UserDepartment::create($request->all() + ['account_id' => Auth::user()->account_id]);

        return redirect()->route('user-departments.index')->with('success', '部署が作成されました。');
    }

    public function edit(UserDepartment $userDepartment)
    {
        $this->ensureAccountId();

        if ($userDepartment->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        return Inertia::render('UserDepartments/Edit', ['userDepartment' => $userDepartment]);
    }

    public function update(Request $request, UserDepartment $userDepartment)
    {
        $this->ensureAccountId();

        if ($userDepartment->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $userDepartment->update($request->all());

        return redirect()->route('user-departments.index')->with('success', '部署が更新されました。');
    }

    public function destroy(UserDepartment $userDepartment)
    {
        $this->ensureAccountId();

        if ($userDepartment->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $userDepartment->delete();

        return redirect()->route('user-departments.index')->with('success', '部署が削除されました。');
    }
}