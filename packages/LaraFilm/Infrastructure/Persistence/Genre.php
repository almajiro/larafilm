<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Genre\Genre as GenreEntity;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class Genre
 *
 * @property string $uuid
 * @property string $name
 * @property string created_at
 * @property string updated_at
 * @package LaraFilm\Infrastructure\Persistence
 */
class Genre extends Model
{
    /**
     * @var string
     */
    public $table = 'genres';

    /**
     * Convert Persistence to Genre Entity.
     *
     * @return GenreEntity
     */
    public function toEntity(): GenreEntity
    {
        return new GenreEntity(
            new Id($this->uuid),
            new ValueObject($this->name),
            $this->created_at ?? new Carbon($this->created_at) ?? null,
            $this->updated_at ?? new Carbon($this->updated_at) ?? null
        );
    }
}
