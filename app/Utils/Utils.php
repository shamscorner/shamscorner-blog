<?php

namespace App\Utils;

class Utils
{
    protected static function resolveFacade($name)
    {
        return app()[$name];
    }

    public static function __callStatic($method, $arguments)
    {
        return (self::resolveFacade('Utils'))->$method(...$arguments);
    }
}
