<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\UserModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends UserModel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;
    /**
     * @ORM\Column(unique=true)
     */
    protected $email;
    /**
     * @ORM\Column(length=50, unique=true)
     */
    protected $username;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="UserSubscription", mappedBy="user", cascade={"remove"})
     */
    private $userSubscription;

    /**
     * @ORM\Column()
     */
    protected $password;
    /**
     * @ORM\Column(type="array")
     */
    protected $roles;
}