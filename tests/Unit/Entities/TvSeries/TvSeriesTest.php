<?php

namespace Tests\Unit\Entities\TvSeries;

use Tests\TestCase;
use App\Entities\TvSeries\TvSeries;
use App\Entities\TvSeries\TvSeriesId;
use App\Entities\ValueObject\Year;

class TvSeriesTest extends TestCase
{
    private function getTvSeries(
        $name = 'Charlotte',
        $year = 2015,
        $overview = 'Key Series'
    ) {
        return new TvSeries(
            TvSeriesId::new(),
            Year::set($year),
            $name,
            $overview
        );
    }

    public function testConstructor()
    {
        $tvSeries = $this->getTvSeries();
        $this->assertInstanceOf(TvSeries::class, $tvSeries);
    }

    public function testNameReturnsCorrectResult()
    {
        $expectedResult = 'STEINS;GATE';
        $tvSeries = $this->getTvSeries($expectedResult);

        $this->assertSame($expectedResult, $tvSeries->getName());
    }

    public function testSetName()
    {
        $expectedResult = 'Angel Beats!';
        $tvSeries = $this->getTvSeries();
        $tvSeries->setName($expectedResult);

        $this->assertSame($expectedResult, $tvSeries->getName());
    }

    public function testYearReturnsCorrectResult()
    {
        $expectedResult = 2015;
        $tvSeries = $this->getTvSeries('Charlotte', $expectedResult);

        $this->assertSame($expectedResult, $tvSeries->getYear()->getValue());
    }
}
