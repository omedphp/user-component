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

    public function setUsername(string $username): self;

    /**
     * @return string|null
     */
    public function getUsernameCanonical(): ?string;

    /**
     * @param string|null $usernameCanonical
     *
     * @return UserInterface
     */
    public function setUsernameCanonical(?string $usernameCanonical): self;

    public function setEmail(string $email): self;

    public function getEmail(): ?string;

    /**
     * @return string|null
     */
    public function getEmailCanonical(): ?string;

    /**
     * @param string|null $emailCanonical
     *
     * @return UserInterface
     */
    public function setEmailCanonical(?string $emailCanonical): self;

    public function getSalt(): ?string;

    public function setSalt(?string $salt): self;

    /**
     * @return string|null
     */
    public function getPassword();

    /**
     * @param string $password
     *
     * @return UserInterface
     */
    public function setPassword($password);

    public function getPlainPassword(): ?string;

    public function setPlainPassword(?string $plainPassword): self;

    public function getLastLogin(): ?\DateTimeInterface;

    public function setLastLogin(?\DateTimeInterface $lastLogin): self;

    public function getEmailVerificationToken(): ?string;

    public function setEmailVerificationToken(?string $emailVerificationToken): self;

    public function getPasswordResetToken(): ?string;

    public function setPasswordResetToken(?string $passwordResetToken): self;

    public function getPasswordRequestedAt(): ?\DateTimeInterface;

    public function setPasswordRequestedAt(?\DateTimeInterface $passwordRequestedAt): self;

    public function getEmailVerifiedAt(): ?\DateTimeInterface;

    public function setEmailVerifiedAt(?\DateTimeInterface $emailVerifiedAt): self;

    public function isLocked(): bool;

    public function setLocked(bool $locked): self;

    public function getCredentialsExpireAt(): ?\DateTimeInterface;

    public function setCredentialsExpireAt(?\DateTimeInterface $credentialsExpireAt): self;
}
