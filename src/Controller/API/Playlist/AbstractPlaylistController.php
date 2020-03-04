<?php

namespace App\Controller\API\Playlist;


use App\Controller\API\AbstractController;
use App\Entity\Playlist;
use App\Service\Entity\PlaylistService;

abstract class AbstractPlaylistController extends AbstractController
{
    /** @var PlaylistService $service */
    protected $service;

    /**
     * @param PlaylistService $service
     * @required
     */
    public function setService(PlaylistService $service): void
    {
        $this->service = $service;
    }

    public function getEntityClassName(): string
    {
        return Playlist::class;
    }
}