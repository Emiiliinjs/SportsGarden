<?php

namespace App\Http\Controllers;

use App\Models\Rumor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RumorController extends Controller
{
    /**
     * Only logged-in users can access these routes
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the Rumors page with the form and list of rumors
     */
    public function index()
    {
        // Get latest rumors, newest first
        $rumors = Rumor::latest()->get();
        return view('rumors.index', compact('rumors'));
    }

    /**
     * Store a new rumor submitted by a user
     */
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:2048', // max 2MB
        ]);

        $path = null;

        // Store image if uploaded
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rumors', 'public');
        }

        // Create new rumor
        Rumor::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $path,
        ]);

        return redirect()->back()->with('success', 'Rumor posted successfully!');
    }

    /**
     * Delete a rumor (only by admins)
     */
    public function destroy(Rumor $rumor)
    {
        $user = Auth::user();

        // Only admins can delete rumors
        if (!$user->is_admin) {
            abort(403, 'Unauthorized action. Only admins can delete rumors.');
        }

        // Delete image if exists
        if ($rumor->image && Storage::disk('public')->exists($rumor->image)) {
            Storage::disk('public')->delete($rumor->image);
        }

        $rumor->delete();

        return redirect()->back()->with('success', 'Rumor deleted successfully!');
    }
}
