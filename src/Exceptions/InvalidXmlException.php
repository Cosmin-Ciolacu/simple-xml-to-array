<?php

namespace CosminCiolacu\SimpleXmlToArray\Exceptions;

class InvalidXmlException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Invalid XML");
    }
}