<?php
/*
 * This file is part of the Omed Project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omed\Component\User\Tests;


use Omed\Component\User\Model\User;
use Omed\Component\User\Model\UserInterface;

class TestUser extends User
{
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