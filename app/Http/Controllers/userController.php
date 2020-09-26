<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'farmname' => 'required|max:240',
            'password' => 'required|min:4'
        ]);

        $email = $request['email'];
        $farmName = $request['farmName'];
        $password = bcrypt($request['password']);

        $user =  new User();
        $user->email = $email;
        $user->farmName = $farmName;
        $user->password = $password;

        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function postLogIn(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) 
        {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function getLogOut() 
    {
        Auth::logout();
        return redirect()->route('home');
    }
}