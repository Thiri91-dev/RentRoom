<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HistoryView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houses = House::with('member')->latest('create_date')->paginate(9);
        return view('houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('houses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|max:100',
            'fee' => 'required|numeric|min:0',
            'gender' => 'required|in:0,1,2',
            'roomtype' => 'required|max:50',
            'no_avaliablity' => 'required|integer|min:0',
            'description' => 'nullable',
        ]);

        $validated['member_id'] = Auth::id();
        $validated['create_date'] = now();
        $validated['update_date'] = now();

        House::create($validated);

        return redirect()->route('houses.index')
            ->with('success', 'House listed successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        // If logged in, record that this member viewed this house
        if (Auth::check()) {
            HistoryView::create([
                'member_id' => Auth::id(),
                'remarks' => 'Viewed house #' . $house->house_id,
                'create_date' => now(),
            ]);
        }
        return view('houses.show', compact('house'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        return view('houses.edit', compact('house'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
    {
        $validated = $request->validate([
            'address' => 'required|max:100',
            'fee' => 'required|numeric|min:0',
            'gender' => 'required|in:0,1,2',
            'roomtype' => 'required|max:50',
            'no_avaliablity' => 'required|integer|min:0',
            'description' => 'nullable',
        ]);

        $validated['update_date'] = now();
        $house->update($validated);

        return redirect()->route('houses.index')
            ->with('success', 'House updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        $house->delete();
        return redirect()->route('houses.index')
            ->with('success', 'Listing removed.');
    }
}
