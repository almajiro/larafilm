<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Company\Company;
use LaraFilm\Domain\Models\Company\CompanyRepositoryInterface;
use LaraFilm\Interfaces\Services\CompanyServiceInterface;

/**
 * Class CompanyService
 *
 * @package LaraFilm\Application\Services
 */
class CompanyService implements CompanyServiceInterface
{
    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    /**
     * CompanyService constructor.
     *
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Get all companies.
     *
     * This function return all companies.
     *
     * @return Company[]
     */
    public function getAll(): array
    {
        return $this->companyRepository->getAll();
    }

    /**
     * Find the company.
     *
     * @param string $id
     * @return Company
     */
    public function findById(string $id): Company
    {
        return $this->companyRepository->findById(new Id($id));
    }

    public function findByName(string $name): Company
    {
        return $this->companyRepository->findByName(new ValueObject($name));
    }

    /**
     * Create the company.
     *
     * @param string $name
     * @return Company
     * @throws \Exception
     */
    public function create(string $name): Company
    {
        $company = new Company(
            new Id(null),
            new ValueObject($name)
        );

        return $this->companyRepository->save($company);
    }

    /**
     * Delete the company.
     *
     * @param Company $company
     * @return bool
     * @throws \Exception
     */
    public function delete(Company $company): bool
    {
        return $this->companyRepository->delete($company);
    }
}
