# General

This package allows creating json responses in easy way.

In order to shorthand JsonResponse creation you can use:

JsonResponse::success // return JsonResponse
JsonResponse::noContent // return JsonResponse, 204 status
JsonResponse::publicError // throws PublicException
JsonResponse::privateError // throws PublicException
JsonResponse::error // return JsonResponse, not using Handler.php of laravel, just returning JSON.

## JsonResponseMixin

JsonResponse functionality extended with class JsonResponseMixin.

## Exceptions

* VisibilityException - parent of PublicException & PrivateException
* PublicException - can obtain printable $data property + has message
* PrivateException - cannot obtain printable $data property, has only message

## How to

### Extend Status Codes

* create a new class and extend StatusCodes.php
* add your own codes or override existing codes
* use your own class while throwing errors

### Extend Mixins

* publish vendor
* create a new class
* write your macroses inside a new class
* use your class in config file laravel-api-response that was recently published

### TODO

* Add more Status Codes
* Add prettier Docs
* Cover with basic tests
