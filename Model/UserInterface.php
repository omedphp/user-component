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

namespace Omed\Component\User\Model;

/**
 * User Interface.
 */
interface UserInterface
{
    public const ROLE_DEFAULT = 'ROLE_USER';

    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    /**
     * Check if user has role.
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role);

    /**
     * Sets the roles of the user.
     *
     * This overwrites any previous roles.
     *
     * @param array $roles
     *
     * @return static
     */
    public function setRoles(array $roles);

    /**
     * Adds a role to the user.
     *
     * @param string $role
     *
     * @return static
     */
    public function addRole(string $role);

    /**
     * Removes a role to the user.
     *
     * @param string $role
     *
     * @return static
     */
    public function removeRole(string $role);

    /**
     * Check if user is enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * Set user enabled.
     *
     * @param bool $enabled
     *
     * @return static
     */
    public function setEnabled(bool $enabled);

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials();

    /**
     * Get current user id.
     */
    public function getId(): ?int;

    public function getUsername(): ?string;

    public function setUsername(string $username);

    /**
     * @return string|null
     */
    public function getUsernameCanonical(): ?string;

    /**
     * @param string|null $usernameCanonical
     *
     * @return static
     */
    public function setUsernameCanonical(?string $usernameCanonical);

    public function setEmail(string $email);

    public function getEmail(): ?string;

    /**
     * @return string|null
     */
    public function getEmailCanonical(): ?string;

    /**
     * @param string|null $emailCanonical
     *
     * @return static
     */
    public function setEmailCanonical(?string $emailCanonical);

    public function getSalt(): ?string;

    public function setSalt(?string $salt);

    /**
     * @return string|null
     */
    public function getPassword();

    /**
     * @param string $password
     *
     * @return static
     */
    public function setPassword(string $password);

    public function getPlainPassword(): ?string;

    public function setPlainPassword(?string $plainPassword);

    public function getLastLogin(): ?\DateTime;

    public function setLastLogin(?\DateTime $lastLogin);

    public function getEmailVerificationToken(): ?string;

    public function setEmailVerificationToken(?string $emailVerificationToken);

    public function getPasswordResetToken(): ?string;

    public function setPasswordResetToken(?string $passwordResetToken);

    public function getPasswordRequestedAt(): ?\DateTime;

    public function setPasswordRequestedAt(?\DateTime $passwordRequestedAt);

    public function getEmailVerifiedAt(): ?\DateTime;

    public function setEmailVerifiedAt(?\DateTime $emailVerifiedAt);

    public function isLocked(): bool;

    public function setLocked(bool $locked);

    public function getCredentialsExpireAt(): ?\DateTime;

    public function setCredentialsExpireAt(?\DateTime $credentialsExpireAt);
}
