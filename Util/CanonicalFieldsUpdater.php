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

namespace Omed\Component\User\Util;

use Omed\Component\User\Model\UserInterface;

class CanonicalFieldsUpdater
{
    /**
     * @var CanonicalizerInterface
     */
    private $usernameCanonicalizer;

    /**
     * @var CanonicalizerInterface
     */
    private $emailCanonicalizer;

    public function __construct(CanonicalizerInterface $usernameCanonicalizer, CanonicalizerInterface $emailCanonicalizer)
    {
        $this->usernameCanonicalizer = $usernameCanonicalizer;
        $this->emailCanonicalizer = $emailCanonicalizer;
    }

    public function updateCanonicalFields(UserInterface $user)
    {
        $user->setUsernameCanonical($this->canonicalizeUsername($user->getUsername()));
        $user->setEmailCanonical($this->canonicalizeEmail($user->getEmail()));
    }

    /**
     * @param string|null $username
     *
     * @return string|null
     */
    public function canonicalizeUsername(?string $username): ?string
    {
        if (null !== $username) {
            return $this->usernameCanonicalizer->canonicalize($username);
        }

        return null;
    }

    /**
     * @param string|null $email
     *
     * @return string|null
     */
    public function canonicalizeEmail(?string $email): ?string
    {
        if (null !== $email) {
            return $this->emailCanonicalizer->canonicalize($email);
        }

        return null;
    }
}
