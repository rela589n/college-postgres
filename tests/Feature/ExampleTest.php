<?php

namespace Tests\Feature;

use App\Casts\UserName;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        /** @var User $user */
        $user=User::find(13);

        self::assertSame('Name in English', $user->name->value());

        $user->name = new UserName('Another en');

        self::assertSame('Another en', $user->name->getFirstName());

        $user->setTranslation('name', 'en', new UserName('Third one'));

        self::assertSame('Third one', $user->name->getFirstName());

        $user->setTranslation('name', 'nl', new UserName('Neth'));

        self::assertSame('Third one', $user->name->getFirstName());

        $user->setLocale('nl');

        self::assertSame('Neth', $user->name->getFirstName());

        $user->name = new UserName('en','some name 1');


    }
}
