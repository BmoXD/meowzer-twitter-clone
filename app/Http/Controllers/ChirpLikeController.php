<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpLikeController extends Controller
{
    public function like (Chirp $chirp)
    {
        $liker = auth()->user();

        $liker ->likes()->attach($chirp);

        return redirect()->route("chirps")->with("success","Liked Successfully");
    }

    public function unlike (Chirp $chirp)
    {
        $liker = auth()->user();

        $liker ->likes()->detach($chirp);

        return redirect()->route("chirps")->with("success","Liked Successfully");
    }
    
}
