<?php

namespace DanWithams\Trading212Api\Exceptions;

use Exception;

class IncorrectResponseException extends Exception
{
    public function __construct($message = "Incorrect Response Encountered")
    {
        parent::__construct($message);
    }
}
