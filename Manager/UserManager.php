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

namespace Omed\Component\User\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Omed\Component\User\Model\UserInterface;

class UserManager
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @var string
     */
    private $class;

    /**
     * UserManager constructor.
     */
    public function __construct(ObjectManager $om, string $class)
    {
        $this->class = $class;
        $this->om = $om;
    }

    /**
     * @return UserInterface
     */
    public function createUser()
    {
        return new $this->class();
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository()
    {
        return $this->om->getRepository($this->class);
    }

    public function storeUser(UserInterface $user, $andFlush = true)
    {
        $om = $this->om;
        $om->persist($user);

        if ($andFlush) {
            $om->flush();
        }
    }

    /**
     * @return UserInterface
     */
    public function findUserBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }
}
