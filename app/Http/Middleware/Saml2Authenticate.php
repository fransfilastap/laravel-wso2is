<?php

namespace App\Http\Middleware;

use Aacotroneo\Saml2\Saml2Auth;
use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Log;

/**
 * @author Frans Filasta Pratama
 * @package App\Http\Middleware
 */
class Saml2Authenticate extends Authenticate
{

    protected function authenticate($request, array $guards)
    {
        $saml2Auth = new Saml2Auth(Saml2Auth::loadOneLoginAuthFromIpdConfig('wso2is'));
        $saml2Auth->login();
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $next($request);
            }
        }

        $this->authenticate($request, $guards);
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route("login");
        }
    }
}
