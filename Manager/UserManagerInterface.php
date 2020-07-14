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

use Doctrine\Common\Persistence\ObjectRepository as CommonObjectRepository;
use Doctrine\Persistence\ObjectRepository;
use Omed\Component\User\Model\UserInterface;
use Omed\Component\User\Util\PasswordUpdaterInterface;

interface UserManagerInterface
{
    /**
     * @return UserInterface
     */
    public function createUser();

    /**
     * @param UserInterface $user
     */
    public function updateCanonicalFields(UserInterface $user);

    /**
     * @return CommonObjectRepository|ObjectRepository
     */
    public function getRepository();

    /**
     * @param UserInterface $user
     * @param bool          $andFlush
     *
     * @return void
     */
    public function storeUser(UserInterface $user, $andFlush = true);

    /**
     * @param UserInterface $user
     */
    public function updatePassword(UserInterface $user);

    /**
     * @param string $username
     *
     * @return object|UserInterface|null
     */
    public function findByUsername(string $username);

    /**
     * @param array $criteria
     *
     * @return object|UserInterface|null
     */
    public function findUserBy(array $criteria);

    /**
     * @return PasswordUpdaterInterface
     */
    public function getPasswordUpdater();
}
