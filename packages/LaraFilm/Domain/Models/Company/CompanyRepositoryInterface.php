<?php

namespace LaraFilm\Domain\Models\Company;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\RepositoryInterface;
use LaraFilm\Domain\Models\Company\Company;

/**
 * Interface CompanyRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Company
 */
interface CompanyRepositoryInterface extends RepositoryInterface
{

    /**
     * Return all companies.
     *
     * @return \LaraFilm\Domain\Models\Company\Company[]
     */
    public function getAll(): array;

    /**
     * Find the company.
     *
     * @param Id $id
     *
     * @return \LaraFilm\Domain\Models\Company\Company
     */
    public function findById(Id $id): Company;

    /**
     * Save the company.
     *
     * @param \LaraFilm\Domain\Models\Company\Company $company
     *
     * @return \LaraFilm\Domain\Models\Company\Company
     */
    public function save(Company $company): Company;

    /**
     * Delete the company.
     *
     * @param \LaraFilm\Domain\Models\Company\Company $company
     *
     * @return bool
     */
    public function delete(Company $company): bool;
}
