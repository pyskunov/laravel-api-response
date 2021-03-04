<?php

namespace Pyskunov\LaravelApiResponse\Support;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class ApiExceptionHandler
{
    public static function handle(Request $request, Throwable $e): ?JsonResponse
    {
        switch ($e) {
            case $e instanceof AuthenticationException:
                return JsonResponse::error(
                    [
                        'message' => __('laravel-api-response::errors.authentication_failed'),
                    ],
                    Response::HTTP_UNAUTHORIZED,
                    StatusCodes::NOT_AUTHENTICATED
                );
            case $e instanceof ThrottleRequestsException:
                return JsonResponse::error(
                    [
                        'message' => __('laravel-api-response::errors.throttled'),
                    ],
                    Response::HTTP_TOO_MANY_REQUESTS,
                    StatusCodes::THROTTLED
                );
            case $e instanceof ModelNotFoundException:
                return JsonResponse::error(
                    [
                        'message' => __('laravel-api-response::errors.model_not_found'),
                        'model' => class_basename($e->getModel()),
                    ],
                    Response::HTTP_BAD_REQUEST,
                    StatusCodes::VALIDATION_ERROR
                );
            case $e instanceof ValidationException:
                return JsonResponse::error(
                    $e->validator->errors()->toArray(),
                    Response::HTTP_BAD_REQUEST,
                    StatusCodes::VALIDATION_ERROR
                );
            default:
                return null;
        }
    }
}
