<?php

namespace LaraFilm\Application\Controllers;

use LaraFilm\Application\Controllers\LaraFilmController;
use LaraFilm\Interfaces\Services\NetworkServiceInterface;

/**
 * Class NetworkController
 *
 * @package LaraFilm\Application\Controllers
 */
class NetworkController extends LaraFilmController
{
    /**
     * @var NetworkServiceInterface
     */
    private $networkService;

    /**
     * NetworkController constructor.
     *
     * @param NetworkServiceInterface $networkService
     */
    public function __construct(NetworkServiceInterface $networkService)
    {
        $this->networkService = $networkService;
    }

    /**
     * Return all networks.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $networksEntities = $this->networkService->getAll();
        $networks = [];

        foreach ($networksEntities as $network) {
            $networks[] = $network->toArray();
        }

        return response()->json($networks);
    }
}
