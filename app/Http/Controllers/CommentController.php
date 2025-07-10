<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'parent_id' => $request->parent_id,
            'is_approved' => true // Auto-approve for now
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function reply(Request $request, Comment $comment): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $comment->post_id,
            'parent_id' => $comment->id,
            'is_approved' => true
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        // Check if user can delete this comment
        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}
