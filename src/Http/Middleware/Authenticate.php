<?php
namespace Enda\YamlSwaggerLaravel\Http\Middleware;

use Closure;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        $auth = session()->get('swagger_auth', false);
        if (!$auth && !empty(config('swagger.auth', null))) {
            return redirect(route('swagger.login'));
        }

        return $next($request);
    }
}
