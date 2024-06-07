<?php

namespace App\Http\Controllers;

use App\Models\UserDepartment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserDepartmentController extends Controller
{
    public function index()
    {
        $userDepartments = UserDepartment::all();
        return Inertia::render('UserDepartments/Index', ['userDepartments' => $userDepartments]);
    }

    public function create()
    {
        return Inertia::render('UserDepartments/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        UserDepartment::create($request->all());

        return redirect()->route('user-departments.index')->with('success', '部署が作成されました。');
    }

    public function edit(UserDepartment $userDepartment)
    {
        return Inertia::render('UserDepartments/Edit', ['userDepartment' => $userDepartment]);
    }

    public function update(Request $request, UserDepartment $userDepartment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $userDepartment->update($request->all());

        return redirect()->route('user-departments.index')->with('success', '部署が更新されました。');
    }

    public function destroy(UserDepartment $userDepartment)
    {
        $userDepartment->delete();

        return redirect()->route('user-departments.index')->with('success', '部署が削除されました。');
    }
}
