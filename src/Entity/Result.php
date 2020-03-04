<?php


namespace App\Entity;


use App\Model\ResultModel;;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResultRepository")
 * @UniqueEntity(fields={"playlist", "track"})
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
     * @ORM\ManyToOne(targetEntity="Playlist", inversedBy="results")
     */
    protected $playlist;
    /**
     * @ORM\ManyToOne(targetEntity="Track")
     */
    protected $track;
}