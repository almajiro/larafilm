<?php

namespace LaraFilm\Domain\Models\Season;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Shared\AbstractEntity;

/**
 * Class Season
 *
 * @package LaraFilm\Domain\Models\Season
 */
class Season extends AbstractEntity
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var Id
     */
    private $tvId;

    /**
     * @var int
     */
    private $season;

    /**
     * @var ValueObject
     */
    private $name;

    /**
     * @var ValueObject
     */
    private $plot;

    /**
     * @var Carbon
     */
    private $createdAt;

    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * Season constructor.
     *
     * @param Id $id
     * @param Id $tvId;
     * @param int $season
     * @param ValueObject $name
     * @param ValueObject $plot
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     */
    public function __construct(
        Id $id,
        Id $tvId,
        int $season,
        ValueObject $name,
        ValueObject $plot,
        Carbon $createdAt = null,
        Carbon $updatedAt = null
    )
    {
        $this->setId($id);
        $this->setTvId($tvId);
        $this->setSeason($season);
        $this->setName($name);
        $this->setPlot($plot);
        $this->setCreatedAt($createdAt);
        $this->setUpdatedAt($updatedAt);
    }

    /**
     * @return Id
     */
    public function id(): Id
    {
        return $this->id;
    }

    /**
     * @return Id
     */
    public function tvId(): Id
    {
        return $this->tvId;
    }

    /**
     * @return int
     */
    public function season(): int
    {
        return $this->season;
    }

    /**
     * @return mixed
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function plot()
    {
        return $this->plot;
    }

    /**
     * @return Carbon
     */
    public function createdAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return Carbon
     */
    public function updatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    /**
     * @param Id $id
     *
     * @return $this
     */
    public function setId(Id $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param Id $tvId
     *
     * @return $this
     */
    public function setTvId(Id $tvId)
    {
        $this->tvId = $tvId;

        return $this;
    }

    /**
     * @param int $season
     *
     * @return $this
     */
    public function setSeason(int $season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * @param ValueObject|null $name
     *
     * @return $this
     */
    public function setName(ValueObject $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param ValueObject|null $plot
     *
     * @return $this
     */
    public function setPlot(ValueObject $plot)
    {
        $this->plot = $plot;

        return $this;
    }

    /**
     * @param Carbon|null $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(Carbon $createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param Carbon|null $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(Carbon $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function toArray(): array
    {
        return array(
            'id' => $this->id()->id(),
            'tv_id' => $this->tvId()->id(),
            'season' => $this->season(),
            'name' => $this->name()->value(),
            'plot' => $this->plot()->value(),
            'created_at' => $this->createdAt->format('Y/m/d H:m:s'),
            'updated_at' => $this->updatedAt->format('Y/m/d H:m:s'),
        );
    }
}
