<?php

namespace Nikolag\Myservice\Exceptions;

use Nikolag\Myservice\Exception;

class MyException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
