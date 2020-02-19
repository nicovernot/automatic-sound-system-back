<?php


namespace App\Entity;


use App\Model\TrackModel;;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrackRepository")
 */
class Track extends TrackModel
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
     * @ORM\Column()
     */
    protected $thumbnails;
    /**
     * @ORM\Column()
     */
    protected $YTTitle;
    /**
     * @ORM\Column()
     */
    protected $YTUrlId;
}