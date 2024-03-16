<?php

namespace App\Exceptions;

class UnableToCreateException extends \Exception
{
    protected $code = 405;

    protected $message = 'Unable to create record';
}
