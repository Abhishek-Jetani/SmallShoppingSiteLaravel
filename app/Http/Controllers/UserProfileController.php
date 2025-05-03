<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('Profile.user_profile');
    }

    public function update(User $user, Request $request)
    {   
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now()
        ]);
        return redirect('/')->with('success', 'Profile updated successfully!');
    }
}
