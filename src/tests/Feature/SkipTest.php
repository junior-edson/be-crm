<?php

namespace Feature;

use Tests\TestCase;

class SkipTest extends TestCase
{
    public function test_can_be_skipped() {
        $this->markTestSkipped('Skip this feature test');
    }
}
