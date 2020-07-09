<?php
namespace Gccm\WindcaveClient\model;

class ProcessResponseTransaction extends AbstractTransaction
{
    public function __construct()
    {
        $this->type = 'ProcessResponse';
        $this->validFields = [
            'PxPayUserId',
            'PxPayKey',
            'Response',
        ];
    }
}
