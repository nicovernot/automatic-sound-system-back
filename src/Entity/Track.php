<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\TrackModel;;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TrackRepository")
 * @UniqueEntity("YTUrlId")
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
     * @ORM\Column(name="yttitle", )
     */
    protected $yTTitle;
    /**
     * @ORM\Column(name="yturl_id", unique=true)
     */
    protected $yTUrlId;
}