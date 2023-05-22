<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function GetProfile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('profile', compact('user'));
    }

    public function UpdateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);


        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }


        try {
            $user = User::where('id', Auth::user()->id)->first();

            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            return back()->with("status", "User updated successfully!");

        } catch (\Throwable $e) {
            return back()->with("error", $e->getMessage());
        }
    }

}
