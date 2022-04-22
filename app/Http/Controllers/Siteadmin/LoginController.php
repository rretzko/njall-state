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
echo 'verified: '.$verified.'<br />';
echo 'isSiteAdmin: '.$user->isSiteAdmin.'<br />';
        if($verified && $user->isSiteAdmin){

            Auth::login($user);
        }else{
            echo 'verified: '.$verified.'<br />Site Admin: '.$user->isSiteAdmin;
        }

        return redirect('/');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
