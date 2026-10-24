<?php

declare(strict_types=1);

namespace app\tests\Unit\Models;

use app\models\UserB;

final class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        /** @var UserB $user */
        $user = UserB::findIdentity(100);

        verify($user)->notEmpty();
        verify($user->username)->equals('admin');
        verify(UserB::findIdentity(999))->empty();
    }

    public function testFindUserByAccessToken()
    {
        /** @var UserB $user */
        $user = UserB::findIdentityByAccessToken('100-token');

        verify($user)->notEmpty();
        verify($user->username)->equals('admin');
        verify(UserB::findIdentityByAccessToken('non-existing'))->empty();
    }

    public function testFindUserByUsername()
    {
        /** @var UserB $user */
        $user = UserB::findByUsername('admin');

        verify($user)->notEmpty();
        verify(UserB::findByUsername('not-admin'))->empty();
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser()
    {
        /** @var UserB $user */
        $user = UserB::findByUsername('admin');

        verify($user->validateAuthKey('test100key'))->notEmpty();
        verify($user->validateAuthKey('test102key'))->empty();
    }
}
