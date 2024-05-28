<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $follower = auth()->user();

        $follower->followings()->attach($user);

        return redirect()->route('users.follow', $user->id)->with('success','Followed User Successfuly');
    }

    public function unfollow()
    {

    }
}
