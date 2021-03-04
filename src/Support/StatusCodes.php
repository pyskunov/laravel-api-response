<?php

namespace Pyskunov\LaravelApiResponse\Support;

class StatusCodes
{
    // Successes
    const OK = 0;
    const CREATED = 1;

    // Errors
    const NOT_ACCEPTABLE = 994;
    const THROTTLED = 995;
    const VALIDATION_ERROR = 996;
    const NOT_AUTHENTICATED = 997;
    const NOT_AUTHORIZED = 998;
    const NOT_FOUND = 999;

    // Not predicted & defaults
    const WHOOPS = 1000;
}
