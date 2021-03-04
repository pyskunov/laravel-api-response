<?php

namespace Vapest\LaravelApiResponse\Exceptions\Visibility;

use Throwable;
use Illuminate\Http\Response;
use Vapest\LaravelApiResponse\Support\StatusCodes;

class PublicException extends VisibilityException
{
    public function __construct(
        string $message = '',
        int $httpCode = Response::HTTP_OK,
        int $code = StatusCodes::OK,
        ?Throwable $prev = null
    ) {
        $this->isPublic = true;

        parent::__construct($message, $httpCode, $code, $prev);
    }
}
