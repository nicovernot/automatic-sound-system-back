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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(type="string", name="endpoint", length=255, nullable=true)
     */
    private $endpoint;

    /**
     * @var string
     * @ORM\Column(type="string", name="public_key", length=255, nullable=true)
     */
    private $publicKey;

    /**
     * @var string
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
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @param string $publicKey
     */
    public function setPublicKey(string $publicKey): void
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @param string $authToken
     */
    public function setAuthToken(string $authToken): void
    {
        $this->authToken = $authToken;
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
