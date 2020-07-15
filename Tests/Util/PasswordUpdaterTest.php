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

namespace Omed\Component\User\Tests\Util;

use Omed\Component\User\Model\UserInterface;
use Omed\Component\User\Tests\TestUser;
use Omed\Component\User\Util\PasswordUpdater;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class PasswordUpdaterTest extends TestCase
{
    /**
     * @var PasswordUpdater
     */
    private $updater;

    /**
     * @var MockObject|EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var MockObject|PasswordEncoderInterface
     */
    private $encoder;

    protected function setUp(): void
    {
        $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
        $this->encoder = $this->createMock(PasswordEncoderInterface::class);
        $this->updater = new PasswordUpdater($this->encoderFactory);
    }

    public function testHashPassword()
    {
        $updater = $this->updater;
        $factory = $this->encoderFactory;
        $encoder = $this->encoder;
        $user = new TestUser();

        $user->setPlainPassword('password');

        $factory->expects($this->any())
            ->method('getEncoder')
            ->with('user')
            ->willReturn($encoder);

        $encoder->expects($this->once())
            ->method('encodePassword')
            ->with('password', $this->isType('string'))
            ->willReturn('encoded');

        $updater->hashPassword($user);
        $this->checkHashPasswordExpectation($user);
    }

    protected function checkHashPasswordExpectation(UserInterface $user)
    {
        $this->assertSame('encoded', $user->getPassword());
        $this->assertNotNull($user->getSalt());
        $this->assertNull($user->getPlainPassword(), '->updatePassword() erases credentials');
    }
}
