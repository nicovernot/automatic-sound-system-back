<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\ChatModel;;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ChatRepository")
 */
class Chat extends ChatModel
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
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;
    /**
     * @ORM\Column(length=250)
     */
    protected $message;
}