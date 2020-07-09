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
 * Class User.
 */
abstract class User implements UserInterface
{
    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var string|null
     */
    protected $username;

    /**
     * @var string|null
     */
    protected $usernameCanonical;

    /**
     * @var string|null
     */
    protected $salt;

    /**
     * @var string|null
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $emailCanonical;

    /**
     * @var string|null
     */
    protected $password;

    /**
     * @var string|null
     */
    protected $plainPassword;

    /**
     * @var \DateTimeInterface|null
     */
    protected $lastLogin;

    /**
     * @var string|null
     */
    protected $emailVerificationToken;

    /**
     * @var string|null
     */
    protected $passwordResetToken;

    /**
     * @var \DateTimeInterface|null
     */
    protected $passwordRequestedAt;

    /**
     * @var \DateTimeInterface|null
     */
    protected $emailVerifiedAt;

    /**
     * @var bool
     */
    protected $locked = false;

    /**
     * @var \DateTimeInterface|null
     */
    protected $credentialsExpireAt;

    /**
     * @var array
     */
    protected $roles = [];

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     *
     * @return UserInterface
     */
    public function setUsername(?string $username): UserInterface
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsernameCanonical(): ?string
    {
        return $this->usernameCanonical;
    }

    /**
     * @param string|null $usernameCanonical
     *
     * @return UserInterface
     */
    public function setUsernameCanonical(?string $usernameCanonical): UserInterface
    {
        $this->usernameCanonical = $usernameCanonical;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailCanonical(): ?string
    {
        return $this->emailCanonical;
    }

    /**
     * @param string|null $emailCanonical
     *
     * @return UserInterface
     */
    public function setEmailCanonical(?string $emailCanonical): UserInterface
    {
        $this->emailCanonical = $emailCanonical;

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    /**
     * @param string|null $salt
     *
     * @return UserInterface
     */
    public function setSalt(?string $salt): UserInterface
    {
        $this->salt = $salt;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return User
     */
    public function setEmail(?string $email): UserInterface
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this|UserInterface
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @return User
     */
    public function setPlainPassword(?string $plainPassword): UserInterface
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    /**
     * @return User
     */
    public function setLastLogin(?\DateTimeInterface $lastLogin): UserInterface
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getEmailVerificationToken(): ?string
    {
        return $this->emailVerificationToken;
    }

    /**
     * @return User
     */
    public function setEmailVerificationToken(?string $emailVerificationToken): UserInterface
    {
        $this->emailVerificationToken = $emailVerificationToken;

        return $this;
    }

    public function getPasswordResetToken(): ?string
    {
        return $this->passwordResetToken;
    }

    /**
     * @return User
     */
    public function setPasswordResetToken(?string $passwordResetToken): UserInterface
    {
        $this->passwordResetToken = $passwordResetToken;

        return $this;
    }

    public function getPasswordRequestedAt(): ?\DateTimeInterface
    {
        return $this->passwordRequestedAt;
    }

    /**
     * @return User
     */
    public function setPasswordRequestedAt(?\DateTimeInterface $passwordRequestedAt): UserInterface
    {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }

    public function getEmailVerifiedAt(): ?\DateTimeInterface
    {
        return $this->emailVerifiedAt;
    }

    /**
     * @return User
     */
    public function setEmailVerifiedAt(?\DateTimeInterface $emailVerifiedAt): UserInterface
    {
        $this->emailVerifiedAt = $emailVerifiedAt;

        return $this;
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * @return User
     */
    public function setLocked(bool $locked): UserInterface
    {
        $this->locked = $locked;

        return $this;
    }

    public function getCredentialsExpireAt(): ?\DateTimeInterface
    {
        return $this->credentialsExpireAt;
    }

    /**
     * @return User
     */
    public function setCredentialsExpireAt(?\DateTimeInterface $credentialsExpireAt): UserInterface
    {
        $this->credentialsExpireAt = $credentialsExpireAt;

        return $this;
    }
}
