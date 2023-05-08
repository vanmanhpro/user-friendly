<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Adldap\Laravel\Facades\Adldap;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        Log::info("login");
        return view('auth/login');
    }

    public function do_login(Request $request)
    {
        Log::info("doing login");
        Auth::attempt([
            'uid' => "manhnv12",
            'password' => "123qwe123"
        ]);

        $user = Auth::user();
//        dd($user);
        return redirect()->route('/');
    }
}
//        $adldap = Adldap::getFacadeRoot();
//        $provider = $adldap->connect();
//        dd($provider->auth());
//        $provider->auth()->attempt("uid=training,dc=example,dc=org", "123qwe123");
//        $results = $provider->search()->where('uid', '=', 'manhnv12')->get();
