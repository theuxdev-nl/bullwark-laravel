<?php

namespace Bullwark\Middlewares;

use Bullwark\Facades\Bullwark;
use Closure;
use Illuminate\Http\Request;

class BullwarkAbility
{
    /**
     * Handle permission checking with flexible parameters
     *
     * @param Request $request
     * @param Closure $next
     * @param string $type - 'ability', 'ability-key', 'role', 'role-key'
     * @param string $all - If user has to match ALL keys given (false = only match one of the keys)
     * @param string ...$abilities - One or more UUIDs/keys to check
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $type, string $all, string ...$abilities)
    {

        $all = $all === 'true' || $all === true;
        // First ensure user is authenticated
        if (!$request->bearerToken()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!Bullwark::authenticate($request->bearerToken())) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $hasPermission = false;
        $checks = [];
        foreach ($abilities as $ability) {

            $check = false;
            switch($type){
                case "ability":
                    $check = Bullwark::userCan($ability);
                    break;
                case "ability-key":
                    $check = Bullwark::userCanKey($ability);
                    break;
                case "role":
                    $check = Bullwark::userHasRole($ability);
                    break;
                case "role-key":
                    $check = Bullwark::userHasRoleKey($ability);
                    break;
            }

            if(!$all && $check){
                $hasPermission = true;
                break;
            }

            $checks[] = $check;
        }

        if($all){
            $hasPermission = !in_array(false, $checks);
        }

        if (!$hasPermission) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}