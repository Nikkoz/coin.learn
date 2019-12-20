<?php

namespace App\Http\Controllers\Admin\Auth;

use \App\Http\Controllers\Auth\ResetPasswordController AS BaseResetPasswordController;
use Illuminate\Http\Request;

class ResetPasswordController extends BaseResetPasswordController
{
    protected $redirectTo = '/admin';

    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
