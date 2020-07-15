<?php

/*
 * This file is part of the Omed project.
 *
 * (c) Anthonius Munthi <https://itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Omed\Component\User\Model;

use Omed\Component\User\Model\UserInterface;
use Omed\Component\User\Tests\TestUser;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @var TestUser
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new TestUser();
    }

    public function testId()
    {
        $target = $this->user;

        $this->assertNull($target->getId());
        $target->setId(1);
        $this->assertEquals(1, $target->getId());
    }

    public function testUsername()
    {
        $target = $this->user;

        $this->assertInstanceOf(UserInterface::class, $target->setUsername('username'));
        $this->assertEquals('username', $target->getUsername());
    }

    public function testUsernameCanonical()
    {
        $target = $this->user;

        $this->assertInstanceOf(UserInterface::class, $target->setUsernameCanonical('canonical'));
        $this->assertEquals('canonical', $target->getUsernameCanonical());
    }

    public function testSalt()
    {
        $target = $this->user;

        $this->assertInstanceOf(UserInterface::class, $target->setSalt('salt'));
        $this->assertEquals('salt', $target->getSalt());
    }

    public function testEmail()
    {
        $target = $this->user;

        $this->assertInstanceOf(UserInterface::class, $target->setEmail('email'));
        $this->assertEquals('email', $target->getEmail());
    }

    public function testEmailCanonical()
    {
        $target = $this->user;

        $this->assertInstanceOf(UserInterface::class, $target->setEmailCanonical('canonical'));
        $this->assertEquals('canonical', $target->getEmailCanonical());
    }

    public function testPassword()
    {
        $target = $this->user;

        $this->assertInstanceOf(UserInterface::class, $target->setPassword('password'));
        $this->assertEquals('password', $target->getPassword());
    }

    public function testPlainPassword()
    {
        $target = $this->user;
        $this->assertInstanceOf(UserInterface::class, $target->setPlainPassword('plain'));
        $this->assertEquals('plain', $target->getPlainPassword());

        $target->eraseCredentials();
        $this->assertNull($target->getPlainPassword());
    }

    public function testLastLogin()
    {
        $target = $this->user;
        $time = $this->createMock(\DateTime::class);

        $this->assertInstanceOf(UserInterface::class, $target->setLastLogin($time));
        $this->assertEquals($time, $target->getLastLogin());
    }

    public function testEmailVerificationToken()
    {
        $target = $this->user;

        $this->assertInstanceOf(UserInterface::class, $target->setEmailVerificationToken('token'));
        $this->assertEquals('token', $target->getEmailVerificationToken());
    }

    public function testPasswordResetToken()
    {
        $target = $this->user;

        $this->assertInstanceOf(UserInterface::class, $target->setPasswordResetToken('token'));
        $this->assertEquals('token', $target->getPasswordResetToken());
    }

    public function testPasswordRequestedAt()
    {
        $target = $this->user;
        $time = $this->createMock(\DateTime::class);

        $this->assertInstanceOf(UserInterface::class, $target->setPasswordRequestedAt($time));
        $this->assertSame($time, $target->getPasswordRequestedAt());
    }

    public function testEmailVerifiedAt()
    {
        $target = $this->user;
        $time = $this->createMock(\DateTime::class);

        $this->assertInstanceOf(UserInterface::class, $target->setEmailVerifiedAt($time));
        $this->assertSame($time, $target->getEmailVerifiedAt());
    }

    public function testLocked()
    {
        $target = $this->user;

        $this->assertFalse($target->isLocked());
        $this->assertInstanceOf(UserInterface::class, $target->setLocked(true));
        $this->assertTrue($target->isLocked());
    }

    public function testEnabled()
    {
        $target = $this->user;

        $this->assertTrue($target->isEnabled());
        $this->assertInstanceOf(UserInterface::class, $target->setEnabled(false));
        $this->assertFalse($target->isEnabled());
    }

    public function testRoles()
    {
        $target = $this->user;

        $this->assertNotEmpty($target->getRoles());
        $this->assertFalse($target->hasRole('FOO'));
        $this->assertInstanceOf(UserInterface::class, $target->addRole('FOO'));
        $this->assertTrue($target->hasRole('FOO'));
        $this->assertContains('FOO', $target->getRoles());
        $this->assertInstanceOf(UserInterface::class, $target->removeRole('foo'));
        $this->assertFalse($target->hasRole('foo'));
        $this->assertTrue($target->hasRole(UserInterface::ROLE_DEFAULT));

        $this->assertInstanceOf(UserInterface::class, $target->setRoles([]));
        $this->assertEmpty($target->getRoles());
    }

    public function testCredentialsExpireAt()
    {
        $target = $this->user;
        $time = $this->createMock(\DateTime::class);

        $this->assertInstanceOf(UserInterface::class, $target->setCredentialsExpireAt($time));
        $this->assertSame($time, $target->getCredentialsExpireAt());
    }
}
