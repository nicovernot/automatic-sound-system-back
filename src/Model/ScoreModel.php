<?php


namespace App\Model;


class ScoreModel extends AbstractUpdatableModel
{
    /** @var null|UserModel $user */
    protected $user;
    /** @var null|PlaylistModel $playlist */
    protected $playlist;
    /** @var null|int $scoreMax */
    protected $scoreMax;
    /** @var null|int $gameCount */
    protected $gameCount;

    public function __construct()
    {
        parent::__construct();

        $this->gameCount = 1;
    }

    /**
     * @return UserModel|null
     */
    public function getUser(): ?UserModel
    {
        return $this->user;
    }

    /**
     * @param UserModel|null $user
     * @return self
     */
    public function setUser(?UserModel $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return PlaylistModel|null
     */
    public function getPlaylist(): ?PlaylistModel
    {
        return $this->playlist;
    }

    /**
     * @param PlaylistModel|null $playlist
     * @return self
     */
    public function setPlaylist(?PlaylistModel $playlist): self
    {
        $this->playlist = $playlist;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScoreMax(): ?int
    {
        return $this->scoreMax;
    }

    /**
     * @param int|null $scoreMax
     * @return self
     */
    public function setScoreMax(?int $scoreMax): self
    {
        $this->scoreMax = $scoreMax;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGameCount(): ?int
    {
        return $this->gameCount;
    }

    /**
     * @param int|null $gameCount
     * @return self
     */
    public function setGameCount(?int $gameCount): self
    {
        $this->gameCount = $gameCount;
        return $this;
    }
}