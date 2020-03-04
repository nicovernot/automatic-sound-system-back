<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\PlaylistModel;;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlaylistRepository")
 */
class Playlist extends PlaylistModel
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
     * @ORM\Column()
     */
    protected $archived;
    /**
     * @ORM\Column(length=100)
     */
    protected $name;
    /**
     * @ORM\Column(type="integer")
     */
    protected $scoreMax;
    /**
     * @ORM\OneToMany(targetEntity="Result", mappedBy="playlist", cascade={"PERSIST"})
     */
    protected $results;
}