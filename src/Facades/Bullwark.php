<?php

namespace Bullwark\Facades;

use Bullwark\Services\BullwarkService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool authenticate(string $token)
 * @method static bool login(string $email, string $password)
 * @method static bool logout()
 * @method static bool refresh()
 * @method static bool isLoggedIn()
 * @method static bool isInitializing()
 * @method static bool userCan(string $ability)
 * @method static bool userCanKey(string $ability)
 * @method static bool userHasRole(string $ability)
 * @method static bool userHasRoleKey(string $ability)
 *
 * @see BullwarkService
 */
class Bullwark extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BullwarkService::class;
    }
}