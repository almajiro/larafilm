<?php

namespace LaraFilm\Domain\Models\Network;

use LaraFilm\Domain\Models\Network\Network;
use LaraFilm\Domain\Shared\RepositoryInterface;

/**
 * Interface NetworkRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Network
 */
interface NetworkRepositoryInterface extends RepositoryInterface
{
    /**
     * @return Network[]
     */
    public function getAll(): array;
}
