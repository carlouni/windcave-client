<?php
namespace Gccm\WindcaveClient\http;

abstract class AbstractHttpClient
{
    protected $endpoint;
    abstract public function submitXml($xml): string;
}
