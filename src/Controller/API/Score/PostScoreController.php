<?php


namespace App\Controller\API\Score;


use ApiPlatform\Core\Exception\ItemNotFoundException;
use App\Entity\Score;
use App\Repository\PlaylistRepository;

class PostScoreController extends AbstractScoreController
{
    //region Repository Playlist
    /** @var PlaylistRepository $playlistRepository */
    private $playlistRepository;

    /**
     * @return PlaylistRepository
     */
    public function getPlaylistRepository(): PlaylistRepository
    {
        return $this->playlistRepository;
    }

    /**
     * @param PlaylistRepository $playlistRepository
     * @required
     */
    public function setPlaylistRepository(PlaylistRepository $playlistRepository): void
    {
        $this->playlistRepository = $playlistRepository;
    }
    //endregion

    public function __invoke(Score $data)
    {
        $playlist = $this->getPlaylistRepository()->find($this->get('id'));
        $user = $this->getUser();

        /** @var Score $score */
        $score = $this->service->findOneBy([
            'playlist' => $playlist,
            'user' => $user
        ]);

        if ($score === null) {
            if ($playlist !== null) {
                $this->service->addScore($data, $user, $playlist);
                $score = $data;
            } else {
                throw new ItemNotFoundException('La playlist demandée est inconnue', 404);
            }
        } else {
            $this->service->updateScore($score, $data->getScoreMax());
        }

        return $score;
    }
}