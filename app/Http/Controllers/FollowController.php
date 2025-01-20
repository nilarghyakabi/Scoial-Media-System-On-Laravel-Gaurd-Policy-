<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        if(auth()->user()->id===$user->id){
            return back()->with('error','You Can not follow yourself');
        }
        
        if (!auth()->user()->isFollowing($user)) {
            auth()->user()->follow($user);
            return back()->with('success', 'You are now following ' . $user->name);
        }
        return back()->with('error','you have already followed');
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);
    
    return back()->with('success', 'You have unfollowed ');
    }
}
