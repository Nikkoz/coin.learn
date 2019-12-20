<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController AS BaseForgotPasswordController;

class ForgotPasswordController extends BaseForgotPasswordController
{
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }
}
