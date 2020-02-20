<?php


namespace App\Entity;


use App\Model\ResultModel;;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResultRepository")
 */
class Result extends ResultModel
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
     * @ORM\Column(length=150)
     */
    protected $title;
    /**
     * @ORM\Column(length=150)
     */
    protected $singer;
    /**
     * @ORM\ManyToOne(targetEntity="Playlist")
     */
    protected $playlist;
    /**
     * @ORM\ManyToOne(targetEntity="Track")
     */
    protected $track;
}