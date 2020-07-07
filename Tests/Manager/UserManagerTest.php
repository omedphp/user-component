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

namespace Tests\Omed\Component\User\Manager;

use Doctrine\Persistence\ObjectRepository;
use Omed\Component\Core\Test\TestCase;
use Omed\Component\Core\Test\TestDatabaseTrait;
use Omed\Component\User\Manager\UserManager;
use Omed\Component\User\Model\User;
use Omed\Component\User\UserComponent;

class UserManagerTest extends TestCase
{
    use TestDatabaseTrait;

    protected function setUp(): void
    {
        $this->addEntityPath(UserComponent::getModelPath());
    }

    public function getUserManager()
    {
        return new UserManager($this->getEntityManager(), User::class);
    }

    public function testGetRepository()
    {
        $manager = new UserManager($this->getEntityManager(), User::class);

        $this->assertInstanceOf(ObjectRepository::class, $manager->getRepository());
    }

    public function testCreate()
    {
        $manager = new UserManager($this->getEntityManager(), User::class);

        $user = $manager->createUser();
        $user->setUsername('test')
            ->setEmail('test@test.com')
            ->setPlainPassword('password')
            ->setPassword('password');

        $manager->storeUser($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertNotNull($user->getId());
    }

    /**
     * @depends testCreate
     */
    public function testFindUserBy()
    {
        $manager = new UserManager($this->getEntityManager(), User::class);
        $user = $manager->createUser();
        $user->setUsername('test')
            ->setEmail('test@test.com')
            ->setPlainPassword('password')
            ->setPassword('password');
        $manager->storeUser($user);

        $user = $manager->findUserBy(['email' => 'test@test.com']);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('test', $user->getUsername());
        $this->assertEquals('test@test.com', $user->getEmail());
        $this->assertEquals('password', $user->getPassword());
        $this->assertEquals('password', $user->getPlainPassword());
    }
}
