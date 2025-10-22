<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class LikeCommentController extends Controller
{
    public function toggleLike(Berita $berita)
    {
        $user = Auth::user();

        // cek apakah sudah like
        $existing = Like::where('user_id', $user->id)->where('berita_id', $berita->id)->first();

        if ($existing) {
            $existing->delete(); // unlike
        } else {
            Like::create([
                'user_id' => $user->id,
                'berita_id' => $berita->id,
            ]);
        }

        return back();
    }


    public function addComment(Request $request, Berita $berita)
    {
        $request->validate(['isi' => 'required|string|max:500']);

        Comment::create([
            'user_id' => Auth::id(),
            'berita_id' => $berita->id,
            'isi' => $request->isi,
        ]);

        return back();
    }
}
