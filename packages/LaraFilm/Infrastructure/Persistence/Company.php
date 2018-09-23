<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Company\Company as CompanyEntity;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class Company
 *
 * @property string $uuid
 * @property string $name
 * @property string created_at
 * @property string updated_at
 * @package LaraFilm\Infrastructure\Persistence
 */
class Company extends Model
{
    /**
     * @var string
     */
    public $table = 'companies';

    /**
     * Convert Persistence to Company Entity.
     *
     * @return CompanyEntity
     */
    public function toEntity(): CompanyEntity
    {
        return new CompanyEntity(
            new Id($this->uuid),
            new ValueObject($this->name),
            $this->created_at ? new Carbon($this->created_at) : null,
            $this->updated_at ? new Carbon($this->updated_at) : null
        );
    }
}
