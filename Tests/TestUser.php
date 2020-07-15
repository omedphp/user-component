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

namespace Omed\Component\User\Tests;

use Omed\Component\User\Model\User;
use Omed\Component\User\Model\UserInterface;

class TestUser extends User
{
    /**
     * TestUser constructor.
     */
    public function __construct()
    {
        $this->addRole(static::ROLE_DEFAULT);
    }

    /**
     * @param int $id
     *
     * @return UserInterface
     */
    public function setId(int $id): UserInterface
    {
        $this->id = $id;

        return $this;
    }
}
