<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function changePassword()
    {
        return view('changePassword');
    }

    public function changePasswordPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "currentPassword" => 'required',
            "password" => 'required|string|min:8',
            "retypePassword" => 'required|same:password',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }


        if(!Hash::check($request->currentPassword, auth()->user()->password)){
            return back()->with("error", "Current Password Doesn't match!");
        }

        try {
            $id = auth()->user()->id;

            $user = User::where('id', $id)->first();
            if ($user && Hash::check($request->currentPassword, $user->password)) {
                $user->update([
                    "password" =>  Hash::make($request->password)
                ]);
                return back()->with("status", "Password changed successfully!");
            } else {
                return back()->with("error", "Password could not change, please try again!");
            }
        } catch (\Throwable $e) {
            return back()->with("error", $e->getMessage());
        }

    }
}
