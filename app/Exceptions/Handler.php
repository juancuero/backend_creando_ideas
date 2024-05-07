<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $exceptionInstance = get_class($exception);
 
        switch ($exceptionInstance) {
            case AuthenticationException::class:
                $status = Response::HTTP_UNAUTHORIZED;
                $message = $exception->getMessage();
                break;
            case AuthorizationException::class:
                $status = Response::HTTP_FORBIDDEN;
                $message = !empty($exception->getMessage()) ? $exception->getMessage() : 'Forbidden';
                break;
            case UnauthorizedException::class:
                $status = Response::HTTP_FORBIDDEN;
                $message = 'You do not have required authorization.';
                break;
            case LockedException::class:
                $status = Response::HTTP_LOCKED;
                $message = $exception->getMessage();
                break;
            case MethodNotAllowedHttpException::class:
                $status = Response::HTTP_METHOD_NOT_ALLOWED;
                $message = 'Method not allowed';
                break;
            case NotFoundHttpException::class:
            case ModelNotFoundException::class:
                $status = Response::HTTP_NOT_FOUND;
                $message = 'The requested resource was not found';
                break;
            case MaintenanceModeException::class:
                $status = Response::HTTP_SERVICE_UNAVAILABLE;
                $message = 'The API is down for maintenance';
                break;
            case QueryException::class: 
                $status = Response::HTTP_BAD_REQUEST;
                $error = 'Internal error QueryException';
                if (!empty($status) && !empty($message)) {
                    $error = $message;
                } 
                
                $message = $error;
                break;
            case ThrottleRequestsException::class:
                $status = Response::HTTP_TOO_MANY_REQUESTS;
                $message = 'Too many Requests';
                break;

            default:
                $status = $exception->getCode();
                $message = $exception->getMessage();
                break;
        }

        if (!empty($status) && !empty($message)) {
            return response()->json([
                'message' => $message,
                'original_message' => $exception->getMessage(),
            ], $status);
        }

        return parent::render($request, $exception);
    }
}
