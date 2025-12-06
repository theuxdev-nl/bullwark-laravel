<?php

namespace Bullwark\Middlewares;
use Bullwark\Facades\Bullwark;

use BullwarkSdk\Exceptions\InvalidSignatureException;
use BullwarkSdk\Exceptions\JwtExpiredException;
use BullwarkSdk\Exceptions\TokenMalformedException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class BullwarkAuth
{
    /**
     * @throws InvalidSignatureException
     * @throws JwtExpiredException
     * @throws GuzzleException
     * @throws TokenMalformedException
     */
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