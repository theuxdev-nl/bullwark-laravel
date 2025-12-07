<?php

return [
    'api_url' => env("BULLWARK_API_URL", ""),
    'jwk_url' => env("BULLWARK_JWK_URL", ""),
    "customer_uuid" => env("BULLWARK_CUSTOMER_UUID", ""),
    "tenant_uuid" => env("BULLWARK_TENANT_UUID", ""),
    "dev_mode" => env("BULLWARK_DEV_MODE", in_array(env("environment"), ["development", "dev", "local"])),
    "cache_ttl" => env("BULLWARK_CACHE_TTL", 300),
];