<?php

use CosminCiolacu\SimpleXmlToArray\SimpleXmlToArray;

beforeEach(function () {
    $this->validXml = '<root><name>John Doe</name></root>';
    $this->invalidXml = '<root><name>John Doe</name>';
});

it('converts valid XML to be an array', function () {
    $result = SimpleXmlToArray::convert($this->validXml);
    expect($result)->toBeArray();
});

it('throws an exception when the XML is invalid', function () {
    expect(function () {
        SimpleXmlToArray::convert($this->invalidXml);
    })
        ->toThrow(CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidXmlException::class);
});
