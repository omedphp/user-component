<?php

declare(strict_types=1);

/*
 * This file is part of the Omed Project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Omed\Component\User\Util;

use Omed\Component\User\Util\CanonicalFieldsUpdater;
use Omed\Component\Core\Test\TestCase;
use Omed\Component\User\Util\CanonicalizerInterface;
use Omed\Component\User\Tests\TestUser;
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
            ->will($this->returnCallback('strtolower'));
        ;

        $this->emailCanonicalizer
            ->expects($this->once())
            ->method('canonicalize')
            ->with('Test@Test.com')
            ->will($this->returnCallback('strtolower'));

        $this->updater->updateCanonicalFields($user);
        $this->assertSame('test',$user->getUsernameCanonical());
        $this->assertSame('test@test.com', $user->getEmailCanonical());
    }

}
