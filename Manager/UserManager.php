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

namespace Omed\Component\User\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Omed\Component\User\Model\UserInterface;
use Omed\Component\User\Util\CanonicalFieldsUpdater;
use Omed\Component\User\Util\PasswordUpdaterInterface;

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
     * @var CanonicalFieldsUpdater
     */
    private $canonicalFieldsUpdater;

    /**
     * @var PasswordUpdaterInterface
     */
    private $passwordUpdater;

    /**
     * UserManager constructor.
     *
     * @param PasswordUpdaterInterface $passwordUpdater
     * @param CanonicalFieldsUpdater   $canonicalFieldsUpdater
     * @param ObjectManager            $om
     * @param string                   $class
     */
    public function __construct(PasswordUpdaterInterface $passwordUpdater, CanonicalFieldsUpdater $canonicalFieldsUpdater, ObjectManager $om, string $class)
    {
        $this->class = $class;
        $this->om = $om;
        $this->canonicalFieldsUpdater = $canonicalFieldsUpdater;
        $this->passwordUpdater = $passwordUpdater;
    }

    /**
     * @return UserInterface
     */
    public function createUser()
    {
        return new $this->class();
    }

    /**
     * @param UserInterface $user
     */
    public function updateCanonicalFields(UserInterface $user)
    {
        $this->canonicalFieldsUpdater->updateCanonicalFields($user);
    }

    /**
     * @return ObjectRepository
     */
    public function getRepository()
    {
        return $this->om->getRepository($this->class);
    }

    public function storeUser(UserInterface $user, $andFlush = true)
    {
        $this->updateCanonicalFields($user);
        $this->updatePassword($user);
        $om = $this->om;
        $om->persist($user);

        if ($andFlush) {
            $om->flush();
        }
    }

    /**
     * @param UserInterface $user
     */
    public function updatePassword(UserInterface $user)
    {
        $this->passwordUpdater->hashPassword($user);
    }

    /**
     * @param array $criteria
     *
     * @return object|UserInterface|null
     */
    public function findUserBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }
}
