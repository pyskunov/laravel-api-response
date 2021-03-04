<?php

namespace Pyskunov\LaravelApiResponse\Exceptions\Visibility;

use Throwable;
use Illuminate\Http\Response;
use Pyskunov\LaravelApiResponse\Support\StatusCodes;

class PrivateException extends VisibilityException
{
    public function __construct(
        string $message = '',
        int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        int $code = StatusCodes::WHOOPS,
        ?Throwable $previous = null
    ) {
        $this->isPublic = false;

        parent::__construct($message, $httpCode, $code, $previous);
    }
}
