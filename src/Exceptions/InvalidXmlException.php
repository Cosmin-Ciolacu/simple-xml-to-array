<?php

namespace CosminCiolacu\SimpleXmlToArray\Exceptions;

class InvalidXmlException extends \Exception
{
    public function __construct(string $xml)
    {
        parent::__construct("Invalid XML: $xml");
    }
}