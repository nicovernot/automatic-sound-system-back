<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\TrackModel;;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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