<?php

namespace App\Entities\TvSeries;

use App\Entities\ValueObject\Year;

class TvSeries
{
    private TvSeriesId $id;

    private Year $year;

    private string $name;

    private string $overview;

    private array $seasons;

    public function __construct(
        TvSeriesId $id,
        Year $year,
        string $name,
        string $overview
    ) {
        $this->id = $id;

        $this->setYear($year);
        $this->setName($name);
        $this->setOverview($overview);
    }

    public function getId(): TvSeriesId
    {
        return $this->id;
    }

    public function getYear(): Year
    {
        return $this->year;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOverview(): string{
        return $this->overview;
    }

    public function setYear(Year $year): void
    {
        $this->year = $year;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }
}
