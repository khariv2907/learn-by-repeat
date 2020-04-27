<?php

namespace Tests\Unit;

use App\Services\RepetitionService;
use Tests\TestCase;

class RepetitionServiceTest extends TestCase
{
    /** @test */
    public function getNextIteration()
    {
        $service = resolve(RepetitionService::class);

        $this->assertEquals(1, $service->getNextIteration(0));
        $this->assertEquals(7, $service->getNextIteration(3));
        $this->assertEquals(180, $service->getNextIteration(180));
    }

    /** @test */
    public function getNewIteration()
    {
        $service = resolve(RepetitionService::class);

        $this->assertEquals(1, $service->getNewIteration());
    }
}
