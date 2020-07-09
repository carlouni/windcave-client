<?php
namespace Gccm\WindcaveClient\model;

abstract class AbstractTransaction
{
    protected $type;
    protected $data = [];
    protected $validFields = [];

    /**
     * Set the value of data
     *
     * @param array $data associative array containing fields.
     * @return void
     */
    public function setData($data)
    {
        $diff = array_diff(array_keys($data), $this->validFields);
        if (!empty($diff)) {
            throw new \RuntimeException("The following key(s) in data are not valid: " . implode(", ", $diff));
        }
        $this->data = $data;
    }

    /**
     * Maps data to XML format.
     */
    public function toXml()
    {
        $xml  = "<{$this->type}>";
        foreach ($this->data as $prop => $val) {
            $xml .= "<$prop>$val</$prop>" ;
        }
        $xml .= "</{$this->type}>";
        return $xml;
    }
}
