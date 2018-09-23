<?php

namespace LaraFilm\Application\Controllers\Companies;

use LaraFilm\Application\Controllers\LaraFilmController;
use LaraFilm\Interfaces\Services\CompanyServiceInterface;

/**
 * Class CompaniesController
 *
 * @package LaraFilm\Application\Controllers
 */
class CompaniesController extends LaraFilmController
{
    /**
     * @var CompanyServiceInterface
     */
    private $companyService;

    /**
     * CompaniesController constructor.
     *
     * @param CompanyServiceInterface $companyService
     */
    public function __construct(CompanyServiceInterface $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Return all companies.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $companyEntities = $this->companyService->getAll();
        $companies = [];

        foreach ($companyEntities as $company) {
            $companies[] = $company->toArray();
        }

        return response()->json($companies);
    }

    public function show()
    {

    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
