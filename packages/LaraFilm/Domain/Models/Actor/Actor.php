<?php

namespace LaraFilm\Domain\Models\Actor;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Shared\AbstractEntity;
use LaraFilm\Domain\Models\Person\Person;

/**
 * Class Actor
 *
 * @package LaraFilm\Domain\Models\Actor
 */
class Actor extends AbstractEntity
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var Person
     */
    private $person;

    /**
     * @var ValueObject
     */
    private $role;

    /**
     * @var Carbon|null
     */
    private $createdAt;

    /**
     * @var Carbon|null
     */
    private $updatedAt;

    /**
     * Actor constructor.
     *
     * @param Id $id
     * @param Person $person
     * @param ValueObject $role
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     */
    public function __construct(
        Id $id,
        Person $person,
        ValueObject $role,
        Carbon $createdAt = null,
        Carbon $updatedAt = null
    ) {
        $this->setId($id);
        $this->setPerson($person);
        $this->setRole($role);
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
     * @return Person
     */
    public function person(): Person
    {
        return $this->person;
    }

    /**
     * @return ValueObject
     */
    public function role(): ValueObject
    {
        return $this->role;
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
     * @param Person $person
     *
     * @return $this
     */
    public function setPerson(Person $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * @param ValueObject $role
     *
     * @return $this
     */
    public function setRole(ValueObject $role)
    {
        $this->role = $role;

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
            'person' => $this->person()->toArray(),
            'role' => $this->role()->value(),
            'created_at' => $this->createdAt()->format('Y/m/d H:m:s'),
            'updated_at' => $this->updatedAt()->format('Y/m/d H:m:s')
        );
    }
}
