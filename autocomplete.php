<?php

namespace Illuminate\Http
{
    use Vapest\LaravelApiResponse\Support\StatusCodes;
    use Vapest\LaravelApiResponse\Mixins\JsonResponseMixin;
    use Vapest\LaravelApiResponse\Exceptions\Visibility\PublicException;
    use Vapest\LaravelApiResponse\Exceptions\Visibility\PrivateException;
    use Throwable;

    class JsonResponse
    {
        /**
         * @see JsonResponseMixin@success
         */
        public static function success(
            array $data = [],
            int $httpCode = Response::HTTP_OK,
            int $code = StatusCodes::OK
        ): JsonResponse {
            return new JsonResponse();
        }

        /**
         * @see JsonResponseMixin@noContent
         */
        public static function noContent(): JsonResponse
        {
            return new JsonResponse();
        }

        /**
         * @see JsonResponseMixin@publicError
         *
         * @throws PublicException
         */
        public static function publicError(
            string $message,
            array $data = [],
            int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR,
            int $code = StatusCodes::WHOOPS,
            ?Throwable $prev = null
        ): void {
            throw new PublicException();
        }

        /**
         * @see JsonResponseMixin@privateError
         *
         * @throws PrivateException
         */
        public static function privateError(
            string $message,
            int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR,
            int $code = StatusCodes::WHOOPS,
            ?Throwable $prev = null
        ): void {
            throw new PrivateException();
        }

        /**
         * @see JsonResponseMixin@error
         */
        public static function error(
            array $data = [],
            int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR,
            int $code = StatusCodes::WHOOPS
        ): JsonResponse {
            return new JsonResponse();
        }
    }
}
