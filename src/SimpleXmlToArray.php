<?php
namespace CosminCiolacu\SimpleXmlToArray;

use CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidPathException;
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
            if (!file_exists($source)) {
                throw new InvalidPathException();
            }
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

    public static function loadFile(string $path): self
    {
        try {
            return new SimpleXmlToArray($path, "file");
        } catch (InvalidPathException $ex) {
            throw new InvalidPathException();
        }
    }
}