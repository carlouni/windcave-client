<?php
namespace Gccm\WindcaveClient\http;

use Gccm\WindcaveClient\http\AbstractHttpClient;

class HttpClientFactory
{
    public static function make($type, $endpoint) : AbstractHttpClient
    {
        try {
            $className = "Gccm\\WindcaveClient\\http\\$type";
            return new $className($endpoint);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
        
    }
}
