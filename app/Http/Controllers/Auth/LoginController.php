<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\ProductImport;

use App\Models\Category;

/** Facades */

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {

        ProductImport::dispatch();
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $login = $request->only('email', 'password');

        if (!Auth::guard('supplier')->attempt($login)) {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();
        return redirect()->intended('/');
    }
}
