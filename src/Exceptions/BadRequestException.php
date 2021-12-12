<?php

namespace Papalapa\Laravel\EmailCodes\Exceptions;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class BadRequestException extends BadRequestHttpException
{
}
