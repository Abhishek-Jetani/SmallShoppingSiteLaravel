<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('Profile.admin_profile');
    }

    public function update(User $user, Request $request)
    {
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => now()
            ]);
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
