<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Person\Person as PersonEntity;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class Person
 *
 * @property string $uuid
 * @property string $name
 * @property string created_at
 * @property string updated_at
 * @package LaraFilm\Infrastructure\Persistence
 */
class Person extends Model
{
    /**
     * @var string
     */
    public $table = 'persons';

    /**
     * Convert Persistence to Person Entity.
     *
     * @return Person
     *
     * @throws \Exception
     */
    public function toEntity(): PersonEntity
    {
        return new PersonEntity(
            new Id($this->uuid),
            new ValueObject($this->name),
            $this->created_at ?? new Carbon($this->created_at) ?? null,
            $this->updated_at ?? new Carbon($this->updated_at) ?? null
        );
    }

}
