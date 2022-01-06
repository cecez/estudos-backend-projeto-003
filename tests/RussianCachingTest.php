<?php

use Cecez\Dolly\RussianCaching;
use Illuminate\Cache\ArrayStore;
use Illuminate\Cache\Repository;

class RussianCachingTest extends TestCase2
{
    /** @test */
    public function it_caches_the_given_key()
    {
        $post = $this->makePost();
        $post2 = $this->makePost();

        $cache = new Repository(new ArrayStore());
        $dolly = new RussianCaching($cache);

        $dolly->cache($post, '<h1>Fragmento para ser cacheado</h1>');
        $dolly->cache($post2->getCacheKey(), '<h1>Fragmento 2 para ser cacheado</h1>');

        $this->assertTrue($dolly->hasCached($post));
        $this->assertTrue($dolly->hasCached($post2->getCacheKey()));
    }
}
