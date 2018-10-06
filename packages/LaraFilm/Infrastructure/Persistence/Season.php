<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Season\Season as SeasonEntity;
use LaraFilm\Infrastructure\Persistence\Tv;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class Season
 *
 * @property string $uuid
 * @property string $tv_uuid
 * @property int $season
 * @property string $name
 * @property string $plot
 * @property string $created_at
 * @property string $updated_at
 * @package LaraFilm\Infrastructure\Persistence
 */
class Season extends Model
{
    /**
     * @var string
     */
    public $table = 'seasons';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tv()
    {
        return $this->belongsTo(
            Tv::class,
            'tv_uuid',
            'uuid'
        );
    }

    /**
     * @return SeasonEntity
     */
    public function toEntity(): SeasonEntity
    {
        return new SeasonEntity(
            new Id($this->uuid),
            new Id($this->tv_uuid),
            $this->season,
            new ValueObject($this->name),
            new ValueObject($this->plot),
            new Carbon($this->created_at),
            new Carbon($this->updated_at)
        );
    }
}
