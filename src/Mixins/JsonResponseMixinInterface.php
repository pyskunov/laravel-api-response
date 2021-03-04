<?php

namespace Vapest\LaravelApiResponse\Mixins;

interface JsonResponseMixinInterface
{
    public function success(): callable;

    public function noContent(): callable;

    public function privateError(): callable;

    public function publicError(): callable;

    public function error(): callable;
}
