<?php


namespace App\Controller\API\Playlist;


use App\Entity\Playlist;

class PostPlaylistController extends AbstractPlaylistController
{
    public function __invoke(Playlist $data)
    {
        $data->setUser($this->getUser());

        $this->service->persistAndFlush($data);

        return $data;
    }
}