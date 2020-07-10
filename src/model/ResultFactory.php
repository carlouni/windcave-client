<?php
namespace Gccm\WindcaveClient\model;

use Gccm\WindcaveClient\model\AbstractResult;

class ResultFactory
{
    public static function make($type) : AbstractResult
    {
        try {
            $className = "Gccm\WindcaveClient\model\\$type";
            return new $className();
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
