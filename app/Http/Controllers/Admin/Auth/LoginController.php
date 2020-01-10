<?php


namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Auth\LoginController AS BaseLoginController;
use Illuminate\Http\Request;

class LoginController extends BaseLoginController
{
    public function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
}