<?php

namespace Cecez\Dolly;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Database\Eloquent\Model;

class RussianCaching
{
    protected static array $keys = [];
    protected Repository $cache;

    public function __construct(Repository $cacheRepository)
    {
        $this->cache = $cacheRepository;
    }

    public static function setUp($model)
    {
        ob_start();

        static::$keys[] = $key = $model->getCacheKey();
        return $this->cache->tags('views')->has($key);
    }

    public static function tearDown()
    {
        $key = array_pop(static::$keys);

        $html = ob_get_clean();

        return $this->cache->tags('views')->rememberForever($key, function () use ($html) {
            return $html;
        });
    }

    public function cache(Model|string $key, string $fragment)
    {
        $key = $this->normalizedKey($key);
        return $this->cache
            ->tags('views')
            ->rememberForever(
                $key,
                function () use ($fragment) { return $fragment; }
            );
    }

    public function hasCached(Model|string $key): bool
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
