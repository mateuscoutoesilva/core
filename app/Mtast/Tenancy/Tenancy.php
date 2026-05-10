<?php

namespace App\Mtast\Tenancy;

use RuntimeException;

class Tenancy
{
    protected static ?int $currentTenantId = null;

    public static function set(int $tenantId): void
    {
        static::$currentTenantId = $tenantId;
    }

    public static function get(): ?int
    {
        return static::$currentTenantId;
    }

    public static function current(): int
    {
        if (static::$currentTenantId === null) {
            throw new RuntimeException('No active tenant in context.');
        }

        return static::$currentTenantId;
    }

    public static function clear(): void
    {
        static::$currentTenantId = null;
    }

    public static function isActive(): bool
    {
        return static::$currentTenantId !== null;
    }
}
