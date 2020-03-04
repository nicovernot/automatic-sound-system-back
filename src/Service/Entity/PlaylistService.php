<?php


namespace App\Service\Entity;


use App\Entity\Playlist;
use App\Repository\PlaylistRepository;
use App\Service\Base\AbstractEntityService;

/**
 * Class PlaylistService
 * @package App\Service\Entity
 *
 * @method PlaylistRepository getRepository() : ObjectRepository
 */
class PlaylistService extends AbstractEntityService
{
    public function getEntityClassName(): string
    {
        return Playlist::class;
    }
}