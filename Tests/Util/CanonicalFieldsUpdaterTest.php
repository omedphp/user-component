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

use PHPUnit\Framework\TestCase;
use Omed\Component\User\Tests\TestUser;
use Omed\Component\User\Util\CanonicalFieldsUpdater;
use Omed\Component\User\Util\CanonicalizerInterface;
use PHPUnit\Framework\MockObject\MockObject;

class CanonicalFieldsUpdaterTest extends TestCase
{
    /**
     * @var CanonicalFieldsUpdater
     */
    private $updater;

    /**
     * @var MockObject
     */
    private $usernameCanonicalizer;

    /**
     * @var MockObject
     */
    private $emailCanonicalizer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usernameCanonicalizer = $this->createMock(CanonicalizerInterface::class);
        $this->emailCanonicalizer = $this->createMock(CanonicalizerInterface::class);
        $this->updater = new CanonicalFieldsUpdater($this->usernameCanonicalizer, $this->emailCanonicalizer);
    }

    public function testCanonicalizeEmail()
    {
        $user = new TestUser();

        $this->updater->updateCanonicalFields($user);
        $this->assertNull($user->getUsernameCanonical());
        $this->assertNull($user->getEmailCanonical());

        $user
            ->setUsername('Test')
            ->setEmail('Test@Test.com');

        $this->usernameCanonicalizer
            ->expects($this->once())
            ->method('canonicalize')
            ->with('Test')
            ->willReturnCallback('strtolower');

        $this->emailCanonicalizer
            ->expects($this->once())
            ->method('canonicalize')
            ->with('Test@Test.com')
            ->willReturnCallback('strtolower');

        $this->updater->updateCanonicalFields($user);
        $this->assertSame('test', $user->getUsernameCanonical());
        $this->assertSame('test@test.com', $user->getEmailCanonical());
    }
}
