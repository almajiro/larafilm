<?php

namespace Tests\Unit\Entities\TvSeries;

use Tests\TestCase;
use App\Entities\TvSeries\TvSeriesId;

class TvSeriesIdTest extends TestCase
{
    public function testNewId()
    {
        $tvSeriesId = TvSeriesId::new();
        $this->assertNull($tvSeriesId->getValue());
    }

    public function testSetId()
    {
        $expectedId = "041ea62d-7a47-4342-8742-d092bd2fdbfc";
        $tvSeriesId = TvSeriesId::set($expectedId);

        $this->assertSame($expectedId, $tvSeriesId->getValue());
    }
}
