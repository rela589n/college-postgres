<?php

namespace Tests\Feature;

use App\Casts\UserAddress;
use App\Casts\UserName;
use App\Models\User;
use Tests\TestCase;

class TranslationsTest extends TestCase
{
    public function testSetLocale()
    {
        $user = new User();

        $user->setLocale('en');
        self::assertSame('en', $user->getLocale());

        $user->setLocale('nl');
        self::assertSame('nl', $user->getLocale());
    }

    public function testSetTranslation(): void
    {
        $user = new User();

        $user->setTranslation('name', 'en', new UserName('First'));
        self::assertSame('First', $user->name->getFirstName());

        $user->setTranslation('name', 'en', new UserName('Second'));
        self::assertSame('Second', $user->name->getFirstName());
    }

    public function testChangeLocale(): void
    {
        $user = new User();

        $user->setLocale('en');
        $user->setTranslation('name', 'en', new UserName('England'));

        self::assertSame('England', $user->name->getFirstName());

        $user->setTranslation('name', 'nl', new UserName('Netherlands'));
        self::assertSame('England', $user->name->getFirstName());

        $user->setLocale('nl');
        self::assertSame('Netherlands', $user->name->getFirstName());
    }

    public function testCreateTranslationForCurrentLocale()
    {
        $user = new User();

        $user->setLocale('en');

        $user->name = new UserName('my name');
        $user->address = new UserAddress('England', 'London');

        self::assertSame('my name', $user->name->getFirstName());
        self::assertSame('England', $user->address->getCountry());
        self::assertSame('London', $user->address->getCity());
    }

    public function testCreateOnOtherLocale(): void
    {
        $user = new User();

        $user->setLocale('nl');

        $user->name = new UserName('my name');
        $user->address = new UserAddress('Netherlands', 'Some city');

        self::assertSame('my name', $user->name->getFirstName());
        self::assertSame('Netherlands', $user->address->getCountry());
        self::assertSame('Some city', $user->address->getCity());

        $user->setLocale('en');

        dd($user->name);
    }

    public function testGetTranslations()
    {
        $user = new User();

        $user->setLocale('nl');

        $user->name = new UserName('my name');
        $user->address = new UserAddress('Netherlands', 'Some city');

        $user->setTranslation('name', 'en', new UserName('English name'));

        dd($user->getAllTranslations());
    }
}
