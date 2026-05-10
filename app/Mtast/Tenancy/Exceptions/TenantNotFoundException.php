<?php

namespace App\Mtast\Tenancy\Exceptions;

use RuntimeException;

class TenantNotFoundException extends RuntimeException
{
    public function __construct(string $slug)
    {
        parent::__construct("Tenant not found for slug: {$slug}");
    }
}
