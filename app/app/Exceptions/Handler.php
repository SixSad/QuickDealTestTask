<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $statusCodes = Response::$statusTexts;

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }
        });

        $this->renderable(function (\Exception $e, Request $request) use ($statusCodes) {

            if (!array_key_exists($e->getCode(), $statusCodes)) {
                $data['message'] = 'Server error';
                $errorCode = 500;
            } else {
                $data['message'] = $e->getMessage();
                $errorCode = $e->getCode();
            }

            if (env('APP_DEBUG')) {
                $data['trace'] = $e->getTrace();
            }

            if ($request->is('api/*')) {
                return response()->json($data, $errorCode);
            }
        });


    }
}

