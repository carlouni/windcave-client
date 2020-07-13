<?php declare(strict_types=1);
namespace Gccm\WindcaveClient\extensions;

use PHPUnit\Runner\BeforeFirstTestHook;

final class LoadDotEnv implements BeforeFirstTestHook
{
    public function executeBeforeFirstTest(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();
    }
}
