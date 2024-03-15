<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
        $api_response = $this->apiResponse($exception,$request);
        $response = response()->json($api_response, $api_response['code']);
        return $response;
    }

    private function apiResponse($exception,$request)
    {
        $trace = $exception->getTraceAsString();
        $message = $exception->getMessage()  && $exception->getMessage()!='' ? $exception->getMessage() : 'Плохой запрос';
        if ($exception instanceof HttpResponseException) {
            $code = $exception->getCode() > 0 ? $exception->getCode() : 500;
            return  ['status'=>false,'message'=>$message . ' | ' .$trace,'code'=>$code];
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException || $exception instanceof  InvalidSignatureException) {
            $expMessage = $exception->getMessage();
            $message = $expMessage && $expMessage!=='' ? $expMessage : __('Authentication::main.token_invalid');
            $code = 401;
            $response = ['status'=>false,'message'=>$message,'code'=>$code];
            return  $response;
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $message = $this->convertValidationExceptionToResponse($exception, $request);
            $code = 400;
            return  ['status'=>false,'message'=>$message,'code'=>$code];
        }

        if ($exception instanceof ModelNotFoundException) {
            $message = 'Ресур не найден';
            $code = 404;
            return  ['status'=>false,'message'=>$message,'code'=>$code];
        }

        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException)  {
            $message = 'Доступ запрещен. Нет прав на данную операцию';
            $expMessage = $exception->getMessage();
            $message = $expMessage && $expMessage!=='' ? $expMessage : $message;
            $code = 403;
            return  ['status'=>false,'message'=>$message,'code'=>$code];
        }

        if ($exception instanceof  MethodNotAllowedHttpException) {
            $message = 'Метод не разрешен';
            $code = 405;
            return  ['status'=>false,'message'=>$message,'code'=>$code];
        }

        if(!isset($code)) {
            return ['status'=>false,'message'=>$message . ' | ' .$trace,'code'=>500];
        }
    }
}
