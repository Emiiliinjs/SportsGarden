<?php

namespace App\Http\Controllers;

use App\Models\Rumor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RumorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display all rumors
     */
    public function index()
    {
        $rumors = Rumor::latest()->get();
        return view('rumors.index', compact('rumors'));
    }

    /**
     * Store a new rumor
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $path = $request->hasFile('image')
            ? $request->file('image')->store('rumors', 'public')
            : null;

        Rumor::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $path,
        ]);

        return redirect()->back()->with('success', 'Rumor posted successfully!');
    }

    /**
     * Show single rumor
     */
    public function show(Rumor $rumor)
    {
        return view('rumors.show', compact('rumor'));
    }

    /**
     * Edit rumor (only owner)
     */
    public function edit(Rumor $rumor)
    {
        if ($rumor->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('rumors.edit', compact('rumor'));
    }

    /**
     * Update rumor (only owner)
     */
    public function update(Request $request, Rumor $rumor)
    {
        if ($rumor->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($rumor->image && Storage::disk('public')->exists($rumor->image)) {
                Storage::disk('public')->delete($rumor->image);
            }
            $validated['image'] = $request->file('image')->store('rumors', 'public');
        }

        $rumor->update($validated);

        return redirect()->route('rumors.show', $rumor)->with('success', 'Rumor updated successfully!');
    }

    /**
     * Delete rumor (only admin)
     */
    public function destroy(Rumor $rumor)
    {
        $user = Auth::user();

        if (!$user->is_admin) {
            abort(403, 'Unauthorized action. Only admins can delete rumors.');
        }

        if ($rumor->image && Storage::disk('public')->exists($rumor->image)) {
            Storage::disk('public')->delete($rumor->image);
        }

        $rumor->delete();

        return redirect()->back()->with('success', 'Rumor deleted successfully!');
    }
}
