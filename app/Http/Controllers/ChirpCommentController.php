<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Models\Comment;


use Illuminate\Http\Request;

class ChirpCommentController extends Controller
{
    public function store(Chirp $chirp)
    {
        $comment = new Comment();
        $comment->chirp_id = $chirp->id;
        $comment->content = request()->content;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->route("chirps", $chirp->id)->with('success', 'Comment successfuly posted!');
    }
}
