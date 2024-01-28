<?php
namespace App\Traits;

use Symfony\Component\HttpKernel\Exception\HttpException;

trait FooBar
{
    public static function all()
    {
        return array_map(function($c)
        {
            return $c->value;
        },self::cases());
    }
}
