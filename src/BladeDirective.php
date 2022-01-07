<?php

namespace Cecez\Dolly;

class BladeDirective
{
    protected array $keys = [];
    private RussianCaching $cache;

    public function __construct(RussianCaching $cache)
    {
        $this->cache = $cache;
    }

    public function setUp($model): bool
    {
        ob_start();
        $this->keys[] = $key = $model->getCacheKey();
        return $this->cache->has($key);
    }

    public function tearDown()
    {
        $html = ob_get_clean();
        $key = array_pop($this->keys);
        return $this->cache->put($key, $html);
    }
}