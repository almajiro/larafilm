<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Actor\Actor as ActorEntity;
use LaraFilm\Infrastructure\Persistence\Person;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class Actor
 *
 * @property string $uuid
 * @property string $person_uuid
 * @property string $role
 * @property string $created_at
 * @property string $updated_at
 * @package LaraFilm\Infrastructure\Persistence
 */
class Actor extends Model
{
    /**
     * @var string
     */
    public $table = 'actors';

    /**
     * @var array
     */
    public $with = ['person'];

    /**
     * Belongs to person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_uuid', 'uuid');
    }

    /**
     * Convert Persistence to Actor Entity.
     *
     * @return ActorEntity
     */
    public function toEntity(): ActorEntity
    {
        return new ActorEntity(
            new Id($this->uuid),
            $this->person->toEntity(),
            new ValueObject($this->role),
            new Carbon($this->created_at),
            new Carbon($this->updated_at)
        );
    }
}
