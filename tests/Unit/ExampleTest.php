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
    expect(/**
     * @throws \CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidXmlException
     */ function () {
        return SimpleXmlToArray::convert($this->invalidXml);
    })
        ->toThrow(CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidXmlException::class);
});

it('validate a xml file', function () {
    $xmlFile = __DIR__ . '/data/valid.xml';
    $result = SimpleXmlToArray::convert($xmlFile, 'file');
    expect($result)->toBeArray();
});

it('throws an exception when the XML file is invalid', function () {
    $xmlFile = __DIR__ . '/data/invalid.xml';
    expect(/**
     * @throws \CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidXmlException
     */ function () use ($xmlFile) {
        return SimpleXmlToArray::convert($xmlFile, 'file');
    })
        ->toThrow(CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidXmlException::class);
});

it("should return false when the XML is invalid", function () {
    $instance = new SimpleXmlToArray($this->invalidXml);
    expect($instance->isValid())->toBeFalse();
});

it("should return true when the XML is valid", function () {
    $instance = new SimpleXmlToArray($this->validXml);
    expect($instance->isValid())->toBeTrue();
});

it("should return an array when the XML is valid", function () {
    $instance = new SimpleXmlToArray($this->validXml);
    expect($instance->getArray())->toBeArray();
});

it("should not throw an exception when the XML file exists", function () {
    $xmlFile = __DIR__ . '/data/valid.xml';
    $instance = SimpleXmlToArray::loadFile($xmlFile);
    expect($instance->isValid())->toBeTrue();
});

it("should throw an exception when the XML file does not exist", function () {
    $xmlFile = __DIR__ . '/data/test.xml';
    expect(/**
     * @throws \CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidPathException
     */ function () use ($xmlFile) {
        return SimpleXmlToArray::loadFile($xmlFile);
    })
        ->toThrow(CosminCiolacu\SimpleXmlToArray\Exceptions\InvalidPathException::class);
});