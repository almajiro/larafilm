<?php

namespace LaraFilm\Domain\Shared;

/**
 * Interface RepositoryInterface
 *
 * @package LaraFilm\Domain\Shared
 */
interface RepositoryInterface
{
    /**
     * Convert Entity to Persistence
     *
     * @param $entity
     *
     * @return mixed
     */
    public function toPersistence($entity);
}
