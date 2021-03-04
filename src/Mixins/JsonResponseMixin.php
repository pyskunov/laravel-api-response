<?php

namespace Vapest\LaravelApiResponse\Mixins;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Vapest\LaravelApiResponse\Support\StatusCodes;
use Vapest\LaravelApiResponse\Exceptions\Visibility\PublicException;
use Vapest\LaravelApiResponse\Exceptions\Visibility\PrivateException;

class JsonResponseMixin
{
    public function success(): callable
    {
        return function (
            array $data = [],
            int $httpCode = Response::HTTP_OK,
            int $code = StatusCodes::OK
        ): JsonResponse {
            return response()->json(
                [
                    'success' => true,
                    'code'    => $code,
                    'data'    => $data,
                ],
                $httpCode
            );
        };
    }

    public function noContent(): callable
    {
        return function (): JsonResponse
        {
            return response()->json([], Response::HTTP_NO_CONTENT);
        };
    }

    public function privateError(): callable
    {
        return function (
            string $message,
            int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR,
            int $code = StatusCodes::WHOOPS,
            ?Throwable $prev = null
        ) {
            throw new PrivateException($message, $httpCode, $code, $prev);
        };
    }

    public function publicError(): callable
    {
        return function (
            string $message,
            array $data = [],
            int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR,
            int $code = StatusCodes::WHOOPS,
            ?Throwable $prev = null
        ) {
            throw (new PublicException($message, $httpCode, $code, $prev))->setData($data);
        };
    }

    public function error(): callable
    {
        return function (
            array $data = [],
            int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR,
            int $code = StatusCodes::WHOOPS
        ): JsonResponse {
            return response()->json(
                [
                    'success' => false,
                    'code'    => $code,
                    'data'    => $data,
                ],
                $httpCode
            );
        };
    }
}
