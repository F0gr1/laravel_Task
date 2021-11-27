<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class GoogleLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        // Google 認証後の処理
        dd($gUser); 
        $gUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email' , $gUser->email)->first();
        if($user == null){
            $user = $this -> createUserByGoogle($gUser);
        }
        \Auth::login($user, true);
        return redirect('/book');       
    }
    public function createUserByGoogle($gUser)
    {
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }
}

