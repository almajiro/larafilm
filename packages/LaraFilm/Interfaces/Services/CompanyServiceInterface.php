<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Company\Company;

/**
 * Interface CompanyServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface CompanyServiceInterface
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
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Company\Company
     */
    public function findById(string $id): Company;

    /**
     * Create the company.
     *
     * @param string $name
     *
     * @return \LaraFilm\Domain\Models\Company\Company
     */
    public function create(string $name): Company;

    /**
     * Delete the company.
     *
     * @param \LaraFilm\Domain\Models\Company\Company $company
     *
     * @return bool
     */
    public function delete(Company $company): bool;
}
