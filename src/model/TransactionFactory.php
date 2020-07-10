<?php
namespace Gccm\WindcaveClient\model;

use Gccm\WindcaveClient\model\AbstractTransaction;

class TransactionFactory
{
    public static function make($type) : AbstractTransaction
    {
        try {
            $className = "Gccm\WindcaveClient\model\\$type";
            return new $className();
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
