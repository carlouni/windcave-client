<?php
namespace Gccm\WindcaveClient;
abstract class AbstractHttpClient {
    protected $endpoint;
    abstract public function submitXml($transaction): string;
}