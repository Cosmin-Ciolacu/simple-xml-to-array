<?php

namespace CosminCiolacu\SimpleXmlToArray\Exceptions;

use \Exception;

class InvalidPathException extends Exception
{
    public function __construct(string $message = "Invalid path", int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}