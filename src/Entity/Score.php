<?php


namespace App\Entity;


use App\Model\ScoreModel;;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScoreRepository")
 */
class Score extends ScoreModel
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
     * @ORM\Column(type="integer")
     */
    protected $scoreMax;
    /**
     * @ORM\Column(type="integer")
     */
    protected $gameCount;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;
    /**
     * @ORM\ManyToOne(targetEntity="Playlist")
     */
    protected $playlist;
}