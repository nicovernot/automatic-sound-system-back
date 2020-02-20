<?php


namespace App\Model;


use Symfony\Component\Security\Core\User\UserInterface;

class UserModel extends AbstractUpdatableModel implements UserInterface
{
    /** @var null|string $username */
    protected $username;
    /** @var null|string $email */
    protected $email;
    /** @var null|string $password */
    protected $password;
    /** @var null|string $plainPassword */
    protected $plainPassword;
    /** @var array $roles */
    protected $roles;

    public function __construct()
    {
        parent::__construct();

        $this->roles = ['ROLE_USER'];
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     * @return UserModel
     */
    public function setUsername(?string $username): UserModel
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return UserModel
     */
    public function setEmail(?string $email): UserModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return UserModel
     */
    public function setPassword(?string $password): UserModel
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string|null $plainPassword
     * @return self
     */
    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return array_unique($this->roles);
    }

    /**
     * @param array $roles
     * @return UserModel
     */
    public function setRoles(array $roles): UserModel
    {
        $this->roles = $roles;
        return $this;
    }

    public function getSalt(){}
    public function eraseCredentials(){}
}