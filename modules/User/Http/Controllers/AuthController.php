<?php

namespace Modules\User\Http\Controllers;

class AuthController
{
    public function __construct()
    {

    }

    public function getLogin()
    {
        return view('user::auth.login');
    }

    public function postLogin()
    {

    }

    public function getLogout()
    {

    }

    public function getReset()
    {

    }
}
