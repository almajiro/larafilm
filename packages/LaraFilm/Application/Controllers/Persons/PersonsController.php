<?php

namespace LaraFilm\Application\Controllers\Persons;

use LaraFilm\Application\Controllers\LaraFilmController;
use LaraFilm\Interfaces\Services\PersonServiceInterface;

class PersonsController
{
    private $personService;

    public function __construct(PersonServiceInterface $personService)
    {
        $this->personService = $personService;
    }

    public function index()
    {
        $personEntities = $this->personService->getAll();
        $persons = [];

        foreach ($personEntities as $person) {
            $persons[] = $person->toArray();
        }

        return response()->json($persons);
    }
}
