<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\UserModel;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
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
     * @ORM\OneToMany(targetEntity="UserSubscription", mappedBy="user", cascade={"remove"})
     */
    protected $userSubscription;

    /**
     * @ORM\Column()
     */
    protected $password;
    /**
     * @ORM\Column(type="array")
     */
    protected $roles;
}