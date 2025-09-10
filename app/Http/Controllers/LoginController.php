<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $cred = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $turnstile_secret     = '0x4AAAAAAAx-ewNeLhbUv8dWxisoCD94j-4';
        $turnstile_response   = $_POST['cf-turnstile-response'];
        $url                  = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
        $post_fields          = "secret=$turnstile_secret&response=$turnstile_response";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response);

        if ($response_data->success) {
            if (Auth::attempt($cred)) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            } else {
                return back()->with('loginError', 'failed')->withInput();
            }
        } else {
            return back()->with('loginError', 'failed')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
