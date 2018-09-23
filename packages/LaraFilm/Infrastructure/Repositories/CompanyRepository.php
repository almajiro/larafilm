<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Company\Company as CompanyEntity;
use LaraFilm\Domain\Models\Company\CompanyRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\Company;

/**
 * Class CompanyRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @var Company
     */
    private $companyPersistence;

    /**
     * CompanyRepository constructor.
     *
     * @param Company $companyPersistence
     */
    public function __construct(Company $companyPersistence)
    {
        $this->companyPersistence = $companyPersistence;
    }

    /**
     * Return all companies.
     *
     * @return \LaraFilm\Domain\Models\Company\Company[]
     */
    public function getAll(): array
    {
        $companyPersistences = $this->companyPersistence->all();
        $companies = [];

        foreach ($companyPersistences as $persistence) {
            $companies[] = $persistence->toEntity();
        }

        return $companies;
    }

    /**
     * Find the company.
     *
     * @param Id $id
     *
     * @return \LaraFilm\Domain\Models\Company\Company
     */
    public function findById(Id $id): CompanyEntity
    {
        $companyPersistence = $this->companyPersistence->find($id->id());
        $company = $companyPersistence->toEntity();

        return $company;
    }

    /**
     * Save the company.
     *
     * @param \LaraFilm\Domain\Models\Company\Company $company
     *
     * @return \LaraFilm\Domain\Models\Company\Company
     * @throws \Exception
     */
    public function save(CompanyEntity $company): CompanyEntity
    {
        $companyPersistence = $this->toPersistence($company);
        $companyPersistence->save();

        $company = $companyPersistence->toEntity();

        return $company;
    }

    /**
     * Delete the company.
     *
     * @param \LaraFilm\Domain\Models\Company\Company $company
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(CompanyEntity $company): bool
    {
        $companyPersistence = $this->toPersistence($company);
        $companyPersistence->delete();

        return true;
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param \LaraFilm\Domain\Models\Company\Company $entity
     *
     * @return Company
     * @throws \Exception
     */
    public function toPersistence($entity): Company
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $companyPersistence = new Company();
        } else {
            $companyPersistence = $this->companyPersistence->find($primaryKey);
        }

        $companyPersistence->name = $entity->name()->value();

        return $companyPersistence;
    }
}
