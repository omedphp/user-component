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
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\SelfSaltingEncoderInterface;

class PasswordUpdater implements PasswordUpdaterInterface
{
    /**
     * @var EncoderFactoryInterface
     */
    protected $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function hash($value, array $options = [])
    {
        $salt = $options['salt'] ?? null;
        $encoder = $this->encoderFactory->getEncoder('user');

        return $encoder->encodePassword($value, $salt);
    }

    /**
     * @param UserInterface $user
     *
     * @throws \Exception if random_bytes was not possible to gather sufficient entropy
     */
    public function hashPassword(UserInterface $user)
    {
        $plainPassword = $user->getPlainPassword();

        if (null === $plainPassword || 0 === \strlen($plainPassword)) {
            return;
        }

        $encoder = $this->encoderFactory->getEncoder('user');

        if ($encoder instanceof SelfSaltingEncoderInterface) {
            $user->setSalt(null);
        } else {
            $salt = rtrim(str_replace('+', '.', base64_encode(random_bytes(32))), '=');
            $user->setSalt($salt);
        }

        $options = ['salt' => $user->getSalt()];
        $hashedPassword = $this->hash($plainPassword, $options);
        $user->setPassword($hashedPassword);
        $user->eraseCredentials();
    }
}
