<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Anthonius Munthi <https://itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Spec\Omed\Component\User\Model;

use Omed\Component\User\Model\User;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(TestUser::class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    public function its_username_should_be_mutable()
    {
        $this->getUsername()->shouldBeNull();
        $this->setUsername('test')->shouldReturn($this);
        $this->getUsername()->shouldReturn('test');
    }

    public function its_salt_should_be_mutable()
    {
        $this->getSalt()->shouldReturn(null);
        $this->setSalt('salt')->shouldReturn($this);
        $this->getSalt()->shouldReturn('salt');
    }

    public function its_credentialsExpireAt_should_be_mutable()
    {
        $date = new \DateTime();
        $this->getCredentialsExpireAt()->shouldBeNull();
        $this->setCredentialsExpireAt($date)->shouldReturn($this);
        $this->getCredentialsExpireAt()->shouldReturn($date);
    }

    public function its_emailVerificationToken_should_be_mutable()
    {
        $this->getEmailVerificationToken()->shouldBeNull();
        $this->setEmailVerificationToken('token')->shouldReturn($this);
        $this->getEmailVerificationToken()->shouldReturn('token');
    }

    public function its_lastLogin_should_be_mutable()
    {
        $this->getLastLogin()->shouldBeNull();
        $this->setLastLogin($date = new \DateTime())->shouldReturn($this);
        $this->getLastLogin()->shouldBe($date);
    }

    public function its_locked_should_be_mutable()
    {
        $this->isLocked()->shouldBe(false);
        $this->setLocked(true)->shouldReturn($this);
        $this->isLocked()->shouldBe(true);
    }

    public function its_password_should_be_mutable()
    {
        $this->getPassword()->shouldBeNull();
        $this->setPassword('password')->shouldReturn($this);
        $this->getPassword()->shouldReturn('password');
    }

    public function its_passwordRequestedAt_should_be_mutable()
    {
        $this->getPasswordRequestedAt()->shouldBeNull();
        $this->setPasswordRequestedAt($date = new \DateTime())->shouldReturn($this);
        $this->getPasswordRequestedAt()->shouldReturn($date);
    }

    public function its_passwordResetToken_should_be_mutable()
    {
        $this->getPasswordResetToken()->shouldBeNull();
        $this->setPasswordResetToken('token')->shouldReturn($this);
        $this->getPasswordResetToken()->shouldReturn('token');
    }

    public function its_plainPassword_should_be_mutable()
    {
        $this->getPlainPassword()->shouldBeNull();
        $this->setPlainPassword('password')->shouldReturn($this);
        $this->getPlainPassword()->shouldReturn('password');
    }

    public function its_emailVerifiedAt_should_be_mutable()
    {
        $this->getEmailVerifiedAt()->shouldBeNull();
        $this->setEmailVerifiedAt($date = new \DateTime())->shouldReturn($this);
        $this->getEmailVerifiedAt()->shouldReturn($date);
    }
}

class TestUser extends User
{
}
