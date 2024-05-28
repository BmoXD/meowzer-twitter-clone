<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //For showing posts in the profile menu
        //$chirps = $user->chirps();

        return view("users.show", compact("user"));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $isEditing = true;
        return view("users.show", compact("user", 'isEditing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validated = request()->validate(
            [
                'name'=> ['required', 'string', 'max:30', 'min:3'],
                'bio' => ['nullable', 'string', 'max:255', 'min:1'],
                'image' => 'image'
            ]
        );

        if(request()->has('image'))
        {
            //public disc
            $pathToImage = request()->file('image')->store('profile','public');
            $validated['image'] = $pathToImage;

            //Deletes already exisiting profile picture
            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route('profile')->with('success','');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }

    public function follow(User $user)
    {
        $follower = auth()->user();

        $follower->followings()->attach($user);

        return redirect()->route('users.show', $user->id)->with('success','Followed User Successfuly');
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();

        $follower->followings()->detach($user);

        return redirect()->route('users.show', $user->id)->with('success','Unfollowed User Successfuly');
    }
}
