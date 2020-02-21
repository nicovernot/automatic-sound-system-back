<?php

namespace App\Entity;

use Minishlink\WebPush\Subscription;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserSubscriptionRepository")
 */
class UserSubscription
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userSubscription")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string|null $endpoint
     * @ORM\Column(type="string", name="endpoint", length=255, nullable=true)
     */
    private $endpoint;

    /**
     * @var string|null $publicKey
     * @ORM\Column(type="string", name="public_key", length=255, nullable=true)
     */
    private $publicKey;

    /**
     * @var string|null $authToken
     * @ORM\Column(type="string", name="auth_token", length=255, nullable=true)
     */
    private $authToken;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string|null
     */
    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    /**
     * @param string|null $endpoint
     * @return UserSubscription
     */
    public function setEndpoint(?string $endpoint): UserSubscription
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPublicKey(): ?string
    {
        return $this->publicKey;
    }

    /**
     * @param string|null $publicKey
     * @return UserSubscription
     */
    public function setPublicKey(?string $publicKey): UserSubscription
    {
        $this->publicKey = $publicKey;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    /**
     * @param string|null $authToken
     * @return UserSubscription
     */
    public function setAuthToken(?string $authToken): UserSubscription
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * @return Subscription
     * @throws \ErrorException
     */
    public function getSubscription() : Subscription
    {
        return Subscription::create([
            "endpoint" => $this->endpoint,
//            "publicKey" => $this->publicKey,
//            "authToken" => $this->authToken,
            "publicKey" => $this->authToken,
            "authToken" => $this->publicKey,
        ]);
    }
}
