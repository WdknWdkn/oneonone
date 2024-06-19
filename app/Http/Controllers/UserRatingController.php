<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRating;
use App\Models\RatingMaster;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserRatingController extends Controller
{
    public function __construct()
    {
        $this->notEnsureUser();

        $this->ensureAccountId();
    }

    public function index(User $user)
    {
        $userRatings = UserRating::where('user_id', $user->id)->with('ratingMaster')->get();
        return Inertia::render('UserRatings/Index', [
            'user' => $user,
            'userRatings' => $userRatings,
        ]);
    }

    public function create(User $user)
    {
        $ratingMasters = RatingMaster::where('account_id', Auth::user()->account_id)->get();
        return Inertia::render('UserRatings/Create', [
            'user' => $user,
            'ratingMasters' => $ratingMasters,
        ]);
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'rating_master_id' => 'required|exists:rating_masters,id',
            'rating_date' => 'required|date',
            'reason' => 'nullable|string',
        ]);

        UserRating::create([
            'user_id' => $user->id,
            'rating_master_id' => $validated['rating_master_id'],
            'rating_date' => $validated['rating_date'],
            'reason' => $validated['reason'],
            'account_id' => Auth::user()->account_id,
        ]);

        return redirect()->route('user-ratings.index', $user->id)->with('success', '評価が登録されました。');
    }

    public function edit(User $user, UserRating $rating)
    {
        if ($rating->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $ratingMasters = RatingMaster::where('account_id', Auth::user()->account_id)->get();
        return Inertia::render('UserRatings/Edit', [
            'user' => $user,
            'userRating' => $rating,
            'ratingMasters' => $ratingMasters,
        ]);
    }

    public function update(Request $request, User $user, UserRating $rating)
    {
        if ($rating->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rating_master_id' => 'required|exists:rating_masters,id',
            'rating_date' => 'required|date',
            'reason' => 'nullable|string',
        ]);

        $rating->update($validated);

        return redirect()->route('user-ratings.index', $user->id)->with('success', '評価が更新されました。');
    }

    public function destroy(User $user, UserRating $rating)
    {
        if ($rating->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $rating->delete();

        return redirect()->route('user-ratings.index', $user->id)->with('success', '評価が削除されました。');
    }
}
