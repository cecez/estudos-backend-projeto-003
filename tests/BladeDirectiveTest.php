<?php

use Cecez\Dolly\BladeDirective;
use Cecez\Dolly\RussianCaching;
use Illuminate\Cache\ArrayStore;
use Illuminate\Cache\Repository;

class BladeDirectiveTest extends TestCase2
{
    /** @test */
    public function it_()
    {
        $bladeDirective = $this->createNewCacheDirective();
    }

    protected function createNewCacheDirective()
    {
        $cache = new Repository(new ArrayStore());
        $dolly = new RussianCaching($cache);
        return new BladeDirective($dolly);
    }
}