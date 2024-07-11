# Simple XML to Array PHP Package

This package provides a simple and efficient way to convert XML data to a PHP array.

## Installation

You can install the package via Composer:

```bash
composer require cosmin-ciolacu/simple-xml-to-array
```

## Usage

```php
use CosminCiolacu\SimpleXmlToArray\SimpleXmlToArray;

$xml = '<root><item>value</item></root>';

$array = SimpleXmlToArray::convert($xml);

print_r($array);
```

if the XML data is invalid it will throw an InvalidxmlException.

```php
use CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidXmlException;
use CosminCiolacu\SimpleXmlToArray\SimpleXmlToArray;

$invalidXml = '<root><item>value</item>';

try {
    $array = SimpleXmlToArray::convert($invalidXml);
} catch (InvalidXmlException $e) {
    echo $e->getMessage();
}
```

## Testing

```bash
./vendor/bin/pest
```