<?php

use Cecez\Dolly\BladeDirective;
use Cecez\Dolly\RussianCaching;
use Illuminate\Cache\ArrayStore;
use Illuminate\Cache\Repository;

class BladeDirectiveTest extends TestCase2
{
    protected RussianCaching $dolly;

    /** @test */
    public function it_()
    {
        $bladeDirective = $this->createNewCacheDirective();
        $isCached = $bladeDirective->setUp($post = $this->makePost());
        echo '<div>output buffering on agora</div>';

        $this->assertFalse($isCached);

        $cachedFragment = $bladeDirective->tearDown();

        $this->assertEquals('<div>output buffering on agora</div>', $cachedFragment);
        $this->assertTrue($this->dolly->has($post));
    }

    protected function createNewCacheDirective()
    {
        $cache = new Repository(new ArrayStore());
        $this->dolly = new RussianCaching($cache);
        return new BladeDirective($this->dolly);
    }
}