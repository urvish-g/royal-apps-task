<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return Redirect::back()->withErrors(['msg' => $validate->errors()]);
        }
        $email = $request['email'];
        $password = $request['password'];

        $response = Http::withHeaders(['accept' => 'application/json'])
            ->post('https://symfony-skeleton.q-tests.com/api/v2/token', [
                'email' => $email,
                'password' => $password,
            ]
        );

        if(isset($response['exception'])) {
            return Redirect::back()->withErrors(['msg' => 'Not valid user']);
        } else {
            session(['response' => $response]);
            session(['first_name' => $response['user']['first_name']]);
            session(['last_name' => $response['user']['last_name']]);
            return redirect('/authors');
        }
    }

    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/');
    }
}
