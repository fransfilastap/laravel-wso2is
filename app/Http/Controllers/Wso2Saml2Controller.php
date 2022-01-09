<?php

namespace App\Http\Controllers;

use Aacotroneo\Saml2\Http\Controllers\Saml2Controller;
use Aacotroneo\Saml2\Saml2Auth;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;

class Wso2Saml2Controller extends Saml2Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function logout(Saml2Auth $saml2Auth, Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        parent::logout($saml2Auth, $request);
    }
}
