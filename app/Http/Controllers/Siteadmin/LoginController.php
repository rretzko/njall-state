<?php

namespace App\Http\Controllers\Siteadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('siteadmin.login');
    }

    public function update(Request $request)
    {
        $inputs = $request->validate([
            'email' => ['required','email','exists:users,email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $inputs['email'])->first();
        $verified = Hash::check($inputs['password'], $user->password);

        if($verified){

            Auth::login($user);
        }

        return redirect('/');
    }
}
