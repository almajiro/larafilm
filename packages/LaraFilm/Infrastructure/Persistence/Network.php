<?php

namespace LaraFilm\Infrastructure\Persistence;

use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class Network
 *
 * @package LaraFilm\Infrastructure\Persistence
 */
class Network extends Model
{
    /**
     * @var string
     */
    public $table = 'networks';

    /**
     * @var bool
     */
    public $timestamps = true;
}
