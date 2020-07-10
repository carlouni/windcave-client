<?php
namespace Gccm\WindcaveClient\model;

class GenerateRequestResult extends AbstractResult
{
    public function __construct()
    {
        $this->validFields = ['URI', 'ResponseText'];
    }
}
