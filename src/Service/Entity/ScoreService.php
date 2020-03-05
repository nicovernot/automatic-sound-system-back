<?php


namespace App\Service\Entity;


use App\Entity\Playlist;
use App\Entity\Score;
use App\Entity\User;
use App\Repository\ScoreRepository;
use App\Service\Base\AbstractEntityService;

/**
 * Class ScoreService
 * @package App\Service\Entity
 *
 * @method ScoreRepository getRepository() : ObjectRepository
 */
class ScoreService extends AbstractEntityService
{
    public function getEntityClassName(): string
    {
        return Score::class;
    }

    public function addScore(Score $data, User $user, Playlist $playlist): void
    {
        $data
            ->setUser($user)
            ->setPlaylist($playlist);

        $this->persistAndFlush($data);
    }

    public function updateScore(Score $score, int $newScoreMax): void
    {
        $score->incrementGameCount();

        if ($score->getScoreMax() < $newScoreMax) {
            $score->setScoreMax($newScoreMax);
        }

        $this->flush();
    }
}