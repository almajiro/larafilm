<?php

namespace App\Exceptions;

use \Throwable;
use LaraFilm\Domain\Constants\LaraFilm;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Class Handler
 * @package App\Throwables
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


    /**
     * @param Throwable $exception
     *
     * @return mixed|void
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        /*
        if ($this->isHttpThrowable($exception)) {
            if($exception->getStatusCode() == 404) {
                return response()->json([
                    'status' => 'failed',
                    'error' => [
                        'Not allowed action'
                    ],
                    'version' => Larafilm::VERSION
                ]);
            }
        }
         */

        return parent::render($request, $exception);
    }
}
