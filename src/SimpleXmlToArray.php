<?php
namespace CosminCiolacu\SimpleXmlToArray;

use CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidXmlException;

class SimpleXmlToArray
{

    /**
     * @var \SimpleXMLElement|bool|null
     */
    private $xmlElement = null;

    public function __construct(string $source, string $mode = "string")
    {
        if ($mode === "string") {
            $this->xmlElement = simplexml_load_string($source);
        } else {
            $this->xmlElement = simplexml_load_file($source);
        }
    }

    /**
     * @throws InvalidXmlException
     * @return \SimpleXMLElement|bool|null
     */
    public function getXmlElement() {
        if ($this->xmlElement === false) {
            throw new InvalidXmlException();
        }

        return $this->xmlElement;
    }

    public function getArray(): array
    {
        return json_decode(json_encode($this->xmlElement), true);
    }

    public function isValid(): bool
    {
        return $this->xmlElement !== false;
    }


    /**
     * @throws InvalidXmlException
     */
    public static function convert(string $source, string $mode = "string"): array
    {
        try {
            $instance = new SimpleXmlToArray($source, $mode);
            $xmlElement = $instance->getXmlElement();
            return json_decode(json_encode($xmlElement), true);
        } catch (InvalidXmlException $ex) {
            throw new InvalidXmlException();
        }
    }
}