<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AddUserController extends Controller
{
    public function AddUser()
    {
        return view('addUser');
    }

    public function AddUserPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }


        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return back()->with("status", "User added successfully!");

        } catch (\Throwable $e) {
            return back()->with("error", $e->getMessage());
        }
    }

}
