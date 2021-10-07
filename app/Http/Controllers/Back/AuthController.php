<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }


    public function loginPost2(Request $request)
    {

        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // Check Email
        $user = User::where('email', '=', $fields['email'])->first();

        // Check Password

        if (!$user || !Hash::check($fields['password'], $user->password)) {

            return  back()->with('fail', 'we do not recognize your email ');

            /*response([
                'message' => 'Bad Creds'
            ], 401);
            */
        } else {
            $request->session()->put('LoggedUser', $user->id);
            return redirect('/admin/dashboard');
        }

        //$token  = $user->createToken('myapptoken')->plainTextToken;

        //$response = [
        //    'user' => $user,
        //    'token' =>  $token,
        //];



        return redirect('/');
    }


    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout(Request $request)
    {

        auth()->logout();
        return redirect()->route('index');
    }
}
