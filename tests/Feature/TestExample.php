<?php

namespace Tests\Feature;

use App\Casts\UserName;
use App\Models\User;
use Tests\TestCase;

class TestExample extends TestCase
{
    public function testBasic()
    {
        /** @var User $user */
//        $user = User::create(
//            [
//                'name' => [
//                    'en' => new UserName('Name in English'),
//                    'nl' => new UserName('Naam in het Nederlands'),
//                ],
//            ]
//        );
        /** @var User $u */

        $u = User::find(12);
        $u->name = new UserName('Name in English 1');

        self::assertSame('Name in English 1', $u->name->getFirstName());

        $u->setTranslation('name', 'en', new UserName('Name in English 2'));

        self::assertSame('Name in English 2', $u->name->getFirstName());

        $u->setTranslations(
            'name',
            [
                'en' => new UserName('Name in English 3'),
                'nl' => new UserName('Naam in het Nederlands'),
            ]
        );

        self::assertSame('Name in English 3', $u->name->getFirstName());

        self::assertSame('Name in English 3', $u->getTranslation('name', 'en')->value());
        self::assertSame('Naam in het Nederlands', $u->getTranslation('name', 'nl')->value());

        dump($u->getTranslations());
//        dd(
//            $u->setTranslations(
//                'name',
//                [
//                    'en' => new UserName('Name in English'),
//                    'nl' => new UserName('Naam in het Nederlands'),
//                ]
//            )
//        );

//        $user->setTranslation('name', 'en', new UserName('Another name in English'));

        dd($user->getAttributes());


//        dd($user);
//
//        $user->name = new UserName('some name');
//
//        dd($user->name);
//
//        $user->save();
    }
}
