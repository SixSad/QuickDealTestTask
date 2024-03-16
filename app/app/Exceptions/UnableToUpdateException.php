<?php

namespace App\Exceptions;

class UnableToUpdateException extends \Exception
{
    protected $code = 405;

    protected $message = 'Unable to update record';
}
