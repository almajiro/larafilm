<?php

namespace LaraFilm\Domain\Models\Tv;

use LaraFilm\Domain\Shared\AbstractEntity;

class Tv extends AbstractEntity
{
    private $id;

    private $name;

    private $originalName;

    private $episodeRunTime;

    private $homepage;

    private $overview;

    private $country;

    private $language;

    private $popularity;

    private $voteAverage;

    private $voteCount;

    private $status;

    private $createdAt;

    private $updatedAt;
}
