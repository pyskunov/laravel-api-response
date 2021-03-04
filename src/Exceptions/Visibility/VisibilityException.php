<?php

namespace Vapest\LaravelApiResponse\Exceptions\Visibility;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Vapest\LaravelApiResponse\Support\StatusCodes;

abstract class VisibilityException extends Exception
{
    protected bool  $isPublic   = false;
    protected array $data       = [];
    protected int   $statusCode = StatusCodes::WHOOPS;

    public function __construct(
        string $message,
        int $httpCode,
        int $code,
        ?Throwable $prev = null
    ) {
        $this->setStatusCode($code);

        parent::__construct($message, $httpCode, $prev);
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getData(): array
    {
        if ($this->isPublic()) {
            return $this->data;
        }

        return [];
    }

    public function render(Request $request): JsonResponse
    {
        $data = [
            'message' => $this->getMessage(),
        ];

        if ($this instanceof PublicException) {
            $data['info'] = $this->data;
        }

        return JsonResponse::error(
            $data,
            $this->getCode(),
            $this->getStatusCode()
        );
    }

    public function report(): void
    {
        //
    }
}
