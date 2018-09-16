<?php

namespace LaraFilm\Domain\Models\Network;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Shared\AbstractEntity;

/**
 * Class Network
 *
 * @package LaraFilm\Domain\Models\Network
 */
class Network extends AbstractEntity
{
    /**
     * @var
     */
    private $id;

    /**
     * @var ValueObject
     */
    private $name;

    /**
     * @var ValueObject
     */
    private $description;

    /**
     * @var
     */
    private $headQuarters;

    /**
     * @var
     */
    private $country;

    /**
     * @var Carbon|null
     */
    private $createdAt;

    /**
     * @var Carbon|null
     */
    private $updatedAt;

    /**
     * Network constructor.
     *
     * @param Id $id
     * @param ValueObject $name
     * @param ValueObject $description
     * @param string|null $headQuarters
     * @param string|null $country
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     */
    public function __construct(
        Id $id,
        ValueObject $name,
        ValueObject $description,
        string $headQuarters = null,
        string $country = null,
        Carbon $createdAt = null,
        Carbon $updatedAt = null
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setDescription($description);
        $this->setHeadQuarters($headQuarters);
        $this->setCountry($country);
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
     * @return ValueObject
     */
    public function name(): ValueObject
    {
        return $this->name;
    }

    /**
     * @return ValueObject
     */
    public function description(): ValueObject
    {
        return $this->description;
    }

    /**
     * @return mixed|string
     */
    public function headQuarters()
    {
        return $this->headQuarters;
    }

    /**
     * @return mixed|string
     */
    public function country()
    {
        return $this->country;
    }

    /**
     * @return mixed|Carbon
     */
    public function createdAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed|Carbon
     */
    public function updatedAt()
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
     * @param ValueObject $name
     *
     * @return $this
     */
    public function setName(ValueObject $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param ValueObject $description
     *
     * @return $this
     */
    public function setDescription(ValueObject $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param mixed $headQuarters
     *
     * @return $this
     */
    public function setHeadQuarters($headQuarters)
    {
        $this->headQuarters = $headQuarters;

        return $this;
    }

    /**
     * @param mixed $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

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

    public function toArray()
    {
        return array(
            'id' => $this->id()->id(),
            'name' => $this->name()->value(),
            'description' => $this->description()->value(),
            'headquarters' => $this->headQuarters(),
            'country' => $this->country(),
            'created_at' => $this->createdAt(),
            'updated_at' => $this->updatedAt()
        );
    }
}
