<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Interview;
use App\Models\UserDepartment;
use App\Models\UserPosition;
use App\Models\UserDepartmentHistory;
use App\Models\UserPositionHistory;
use App\Queries\UserQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->notEnsureUser();

        $this->ensureAccountId();
    }

    public function index(Request $request)
    {
        $userQuery = new UserQuery($request);
        $users = $userQuery->apply()->where('account_id', Auth::user()->account_id)->with(['department', 'position'])->get();
        $params = $userQuery->getParams();

        return Inertia::render('Users/Index', [
            'users' => $users,
            'params' => $params,
        ]);
    }

    public function show(User $user)
    {
        if ($user->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $user->load(['department', 'position']);
        return Inertia::render('Users/Detail', ['user' => $user]);
    }

    public function getUserInterviews($id)
    {
        $interviews = Interview::with([
            'interviewer',
            'interviewee',
            'interviewAnswers.templateItem'
        ])
        ->where('interviewer_id', $id)
        ->where('account_id', Auth::user()->account_id)
        ->get();
        
        return response()->json(['interviews' => $interviews]);
    }

    public function updatePosition(Request $request, User $user)
    {
        $request->validate([
            'position_id' => 'required|exists:user_positions,id',
        ]);

        if ($user->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // ユーザーの役職を更新
            $user->update([
                'current_position_id' => $request->position_id,
            ]);

            // 更新後の役職を履歴に追加
            UserPositionHistory::create([
                'user_id' => $user->id,
                'user_position_id' => $request->position_id,
                'start_date' => date('Y-m-d'),
                'account_id' => Auth::user()->account_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('役職の更新に失敗しました。');
        }
        
        return redirect()->route('users.show', ['user' => $user->id])->with('success', '役職が更新されました。');
    }

    public function updateDepartment(Request $request, User $user)
    {
        $request->validate([
            'department_id' => 'required|exists:user_departments,id',
        ]);

        if ($user->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // ユーザーの部署を更新
            $user->update([
                'current_department_id' => $request->department_id,
            ]);

            // 更新後の部署を履歴に追加
            UserDepartmentHistory::create([
                'user_id' => $user->id,
                'user_department_id' => $request->department_id,
                'start_date' => date('Y-m-d'),
                'account_id' => Auth::user()->account_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('部署の更新に失敗しました。');
        }
    
        return redirect()->route('users.show', ['user' => $user->id])->with('success', '部署が更新されました。');
    }
}
