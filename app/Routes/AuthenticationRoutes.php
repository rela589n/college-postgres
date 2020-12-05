<?php


namespace App\Routes;


interface AuthenticationRoutes
{
    public static function login(): string;

    public static function home(): string;
}
