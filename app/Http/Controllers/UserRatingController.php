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
    public function index(User $user)
    {
        $this->ensureAccountId();

        $userRatings = UserRating::where('user_id', $user->id)->with('ratingMaster')->get();
        return Inertia::render('UserRatings/Index', [
            'user' => $user,
            'userRatings' => $userRatings,
        ]);
    }

    public function create(User $user)
    {
        $this->ensureAccountId();

        $ratingMasters = RatingMaster::where('account_id', Auth::user()->account_id)->get();
        return Inertia::render('UserRatings/Create', [
            'user' => $user,
            'ratingMasters' => $ratingMasters,
        ]);
    }

    public function store(Request $request, User $user)
    {
        $this->ensureAccountId();

        $validated = $request->validate([
            'rating_master_id' => 'required|exists:rating_masters,id',
            'rating_date' => 'required|date',
        ]);

        UserRating::create([
            'user_id' => $user->id,
            'rating_master_id' => $validated['rating_master_id'],
            'rating_date' => $validated['rating_date'],
            'account_id' => Auth::user()->account_id,
        ]);

        return redirect()->route('user-ratings.index', $user->id)->with('success', '評価が登録されました。');
    }

    public function edit(User $user, UserRating $rating)
    {
        $this->ensureAccountId();

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
        $this->ensureAccountId();

        if ($rating->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rating_master_id' => 'required|exists:rating_masters,id',
            'rating_date' => 'required|date',
        ]);

        $rating->update($validated);

        return redirect()->route('user-ratings.index', $user->id)->with('success', '評価が更新されました。');
    }

    public function destroy(User $user, UserRating $rating)
    {
        $this->ensureAccountId();

        if ($rating->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $rating->delete();

        return redirect()->route('user-ratings.index', $user->id)->with('success', '評価が削除されました。');
    }
}