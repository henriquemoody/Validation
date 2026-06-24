<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use DateInterval;
use Psr\SimpleCache\CacheInterface;

use function preg_match;

/**
 * Serializable PSR-16 in-memory cache.
 *
 * Stores values in a plain PHP array so the cache can be serialized
 * alongside the Validators that hold it. No closures, no anonymous classes.
 *
 * @internal
 */
final class InMemoryCache implements CacheInterface
{
    private const string KEY_PATTERN = '/^[A-Za-z0-9_.-]+$/';

    /** @var array<string, mixed> */
    private array $store = [];

    public function get(string $key, mixed $default = null): mixed
    {
        $this->validateKey($key);

        return $this->store[$key] ?? $default;
    }

    public function set(string $key, mixed $value, int|DateInterval|null $ttl = null): bool
    {
        $this->validateKey($key);
        $this->store[$key] = $value;

        return true;
    }

    public function delete(string $key): bool
    {
        $this->validateKey($key);
        unset($this->store[$key]);

        return true;
    }

    public function clear(): bool
    {
        $this->store = [];

        return true;
    }

    /**
     * @param iterable<string> $keys
     *
     * @return iterable<string, mixed>
     */
    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $result = [];
        foreach ($keys as $key) {
            $this->validateKey($key);
            $result[$key] = $this->store[$key] ?? $default;
        }

        return $result;
    }

    /** @param iterable<string, mixed> $values */
    public function setMultiple(iterable $values, int|DateInterval|null $ttl = null): bool
    {
        foreach ($values as $key => $value) {
            $this->validateKey((string) $key);
            $this->store[(string) $key] = $value;
        }

        return true;
    }

    /** @param iterable<string> $keys */
    public function deleteMultiple(iterable $keys): bool
    {
        foreach ($keys as $key) {
            $this->validateKey($key);
            unset($this->store[$key]);
        }

        return true;
    }

    public function has(string $key): bool
    {
        $this->validateKey($key);

        return isset($this->store[$key]);
    }

    /** @throws InvalidCacheKey */
    private function validateKey(string $key): void
    {
        if ($key === '' || preg_match(self::KEY_PATTERN, $key) !== 1) {
            throw new InvalidCacheKey(
                'Cache key must be a non-empty string matching /^[A-Za-z0-9_.-]+$/, got: ' . $key,
            );
        }
    }
}
