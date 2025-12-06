<?php

namespace Bullwark\Services;

use BullwarkSdk\BullwarkSdk;
use BullwarkSdk\Exceptions\InvalidSignatureException;
use BullwarkSdk\Exceptions\JwtExpiredException;
use BullwarkSdk\Exceptions\TokenMalformedException;
use GuzzleHttp\Exception\GuzzleException;

class BullwarkService
{
    private BullwarkSdk $bullwarkSdk;

    public function __construct()
    {
        $this->bullwarkSdk = new BullwarkSdk(
            config('bullwark.api_url'),
            config('bullwark.jwk_url'),
            config('bullwark.tenant_uuid'),
            config('bullwark.customer_uuid'),
            config('bullwark.dev_mode'),
            config('bullwark.cache_ttl')
        );
    }

    public function isLoggedIn(): bool
    {
        return $this->bullwarkSdk->getIsLoggedIn();
    }

    public function isInitializing(): bool
    {
        return $this->bullwarkSdk->getIsInitializing();
    }

    public function setTenantUuid(string $tenantUuid): void
    {
        return $this->bullwarkSdk->setTenantUuid($tenantUuid);
    }

    public function login(string $email, string $password): bool
    {
        return $this->bullwarkSdk->login($email, $password);
    }

    /**
     * @throws InvalidSignatureException
     * @throws JwtExpiredException
     * @throws GuzzleException
     * @throws TokenMalformedException
     */
    public function refresh(): bool
    {
        return $this->bullwarkSdk->refresh();
    }

    /**
     * @throws InvalidSignatureException
     * @throws GuzzleException
     * @throws JwtExpiredException
     * @throws TokenMalformedException
     */
    public function authenticate(string $token): bool
    {
        return $this->bullwarkSdk->authenticate($token);
    }

    /**
     * @throws \Exception
     */
    public function logout(): bool
    {
        return $this->bullwarkSdk->logout();
    }
}