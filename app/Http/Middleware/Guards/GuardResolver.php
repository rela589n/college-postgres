<?php


namespace App\Http\Middleware\Guards;


final class GuardResolver
{
    public static function reverse(string $guardName): string
    {
        $className = explode('_', $guardName)[1];

        if (!class_exists($className)) {
            throw new \RuntimeException('Could not locate model for guard '.$guardName);
        }

        return $className;
    }
}
