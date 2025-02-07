<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (!Session::has('token')) {
            return view('auth.login');
        }else{
            return redirect()->route('dashboard');
            // return view('dashboard');

        }
    }

    public function login(Request $request)
    {
        $response = Http::post('https://candidate-testing.com/api/v2/token', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // echo"<pre>";
        //print_r($request);
        // print_r($response);
        // die;

        if ($response->successful()) {
            $data = $response->json();
            // echo"<pre>";
            // print_r($data);
            // echo"</pre>";

            Session::put('token', $data['token_key']);
            Session::put('user', $data['user']);
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['error' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
