<?php

namespace LaraFilm\Application\Controllers;

use LaraFilm\Interfaces\Controllers\LaraFilmController as Controller;

/**
 * Class LaraFilmController
 *
 * @package LaraFilm\Application\Controllers
 */
class LaraFilmController extends Controller
{
    /**
     * Return application name.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function version()
    {
        return response()->json([
            'name' => config('app.name')
        ]);
    }
}
