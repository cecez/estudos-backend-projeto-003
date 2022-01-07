<?php

namespace Cecez\Dolly;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Database\Eloquent\Model;

class RussianCaching
{
    protected Repository $cache;

    public function __construct(Repository $cacheRepository)
    {
        $this->cache = $cacheRepository;
    }

    public function put(Model|string $key, string $fragment)
    {
        $key = $this->normalizedKey($key);
        return $this->cache
            ->tags('views')
            ->rememberForever(
                $key,
                function () use ($fragment) { return $fragment; }
            );
    }

    public function has(Model|string $key): bool
    {
        $key = $this->normalizedKey($key);
        return $this->cache->tags('views')->has($key);
    }

    private function normalizedKey(Model|string $key): string
    {
        if ($key instanceof Model) {
            return $key->getCacheKey();
        }

        return $key;
    }
}
