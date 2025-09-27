<?php

namespace Bullwark\Middlewares;

use Bullwark\Facades\Bullwark;
use Closure;
use Illuminate\Routing\Controllers\Middleware;

class HasRoles extends Middleware
{
    public function handle($request, Closure $next, ...$roles)
    {

    }
}