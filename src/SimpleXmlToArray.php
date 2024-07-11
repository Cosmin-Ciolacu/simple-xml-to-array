<?php
namespace CosminCiolacu\SimpleXmlToArray;

use CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidXmlException;

class SimpleXmlToArray
{
    public static function convert(string $xml): array
    {
        $xmlObject = simplexml_load_string($xml);
        if ($xmlObject === false) {
            throw new InvalidXmlException($xml);
        }

        $json = json_encode($xmlObject);
        return json_decode($json, true);
    }
}