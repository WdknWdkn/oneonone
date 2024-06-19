<?php

namespace App\Http\Controllers;

use App\Models\RatingMaster;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class RatingMasterController extends Controller
{
    public function __construct()
    {
        $this->notEnsureUser();

        $this->ensureAccountId();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $ratingMasters = RatingMaster::where('account_id', Auth::user()->account_id)->get();
        return Inertia::render('RatingMasters/Index', [
            'ratingMasters' => $ratingMasters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('RatingMasters/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        RatingMaster::create($validated + ['account_id' => Auth::user()->account_id]);

        return redirect()->route('rating-masters.index')->with('success', '評価マスターが作成されました。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RatingMaster  $ratingMaster
     * @return \Inertia\Response
     */
    public function edit(RatingMaster $ratingMaster)
    {
        if ($ratingMaster->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        return Inertia::render('RatingMasters/Edit', [
            'ratingMaster' => $ratingMaster,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RatingMaster  $ratingMaster
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RatingMaster $ratingMaster)
    {

        if ($ratingMaster->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rating_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $ratingMaster->update($validated);

        return redirect()->route('rating-masters.index')->with('success', '評価マスターが更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RatingMaster  $ratingMaster
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RatingMaster $ratingMaster)
    {
        if ($ratingMaster->account_id !== Auth::user()->account_id) {
            abort(403, 'Unauthorized action.');
        }

        $ratingMaster->delete();

        return redirect()->route('rating-masters.index')->with('success', '評価マスターが削除されました。');
    }
}
