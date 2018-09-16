<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Network\Network;

/**
 * Interface NetworkServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface NetworkServiceInterface
{
    /**
     * Return all networks.
     *
     * @return Network[]
     */
    public function getAll(): array;
}
