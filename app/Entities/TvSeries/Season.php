<?php

namespace App\Entities\TvSeries;

class Season
{
    private int $season;

    private array $episodes;

    public function __construct(int $season, array $episodes)
    {
        $this->season = $season;
        $this->setEpisodes($episodes);
    }

    public function getSeason(): int
    {
        return $this->season;
    }

    public function addEpisode($episode)
    {
        $this->episodes[] = $episode;
    }

    private function setEpisodes(array $episodes)
    {
        foreach ($episodes as $episode) {
            $this->addEpisode($episode);
        }
    }
}
