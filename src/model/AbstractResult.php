<?php
namespace Gccm\WindcaveClient\model;

use Gccm\WindcaveClient\parser\XMLParser;

abstract class AbstractResult
{
    protected $data = [];
    protected $validFields = [];

    public function setXml($xml)
    {
        $doc = new XMLParser($xml);
        foreach ($this->validFields as $field) {
            $this->data[$field] = $doc->get_element_text($field);
        }
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
