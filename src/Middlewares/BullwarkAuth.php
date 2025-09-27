<?php

namespace Bullwark\Middlewares;
use Bullwark\Facades\Bullwark;

use Illuminate\Http\Request;

class BullwarkAuth
{
    public function handle(Request $request, \Closure $closure)
    {
        if (!$request->bearerToken()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!Bullwark::authenticate($request->bearerToken())) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        return $closure($request);
    }
}