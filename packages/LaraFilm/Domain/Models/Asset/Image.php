<?php

namespace LaraFilm\Domain\Models\Asset;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Asset\Asset;
use LaraFilm\Domain\Shared\AbstractEntity;

/**
 * Class Image
 *
 * @package LaraFilm\Domain\Models\Asset
 */
class Image
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var int
     */
    private $type;

    /**
     * @var Carbon
     */
    private $createdAt;

    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * Image constructor.
     *
     * @param Id $id
     * @param \LaraFilm\Domain\Models\Asset\Asset $asset
     * @param int $type
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     */
    public function __construct(
        Id $id,
        Asset $asset,
        int $type,
        Carbon $createdAt = null,
        Carbon $updatedAt = null
    ) {
        $this->setId($id);
        $this->setAsset($asset);
        $this->setType($type);
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
     * @return \LaraFilm\Domain\Models\Asset\Asset
     */
    public function asset(): Asset
    {
        return $this->asset;
    }

    /**
     * @return int
     */
    public function type(): int
    {
        return $this->type;
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
     * @param \LaraFilm\Domain\Models\Asset\Asset $asset
     *
     * @return $this
     */
    public function setAsset(Asset $asset)
    {
        $this->asset = $asset;

        return $this;
    }

    /**
     * @param int $type
     *
     * @return $this
     */
    public function setType(int $type)
    {
        $this->type = $type;

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
            'type' => $this->type(),
            'asset' => $this->asset()->toArray()
        );
    }
}
