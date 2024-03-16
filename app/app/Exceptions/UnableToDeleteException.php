<?php

namespace App\Exceptions;

class UnableToDeleteException extends \Exception
{
    protected $code = 405;

    protected $message = 'Unable to delete record';
}
