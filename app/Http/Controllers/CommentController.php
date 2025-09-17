<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rumor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Tikai autentificēti lietotāji drīkst pievienot komentārus
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Saglabā jaunu komentāru pie konkrētā rumor
     */
    public function store(Request $request, Rumor $rumor)
    {
        // Validācija
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Izveido komentāru, sasaistot ar rumor un lietotāju
        $rumor->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()
            ->route('rumors.show', $rumor)
            ->with('success', '💬 Comment posted successfully!');
    }

    /**
     * (Papildus) Iespēja dzēst komentāru – tikai autors vai admins
     */
    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        if ($user->id !== $comment->user_id && !$user->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()
            ->route('rumors.show', $comment->rumor_id)
            ->with('success', '🗑️ Comment deleted successfully!');
    }
}
