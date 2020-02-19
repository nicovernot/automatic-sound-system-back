<?php


namespace App\Model;


class ResultModel extends AbstractModel
{
    /** @var null|string $title */
    protected $title;
    /** @var null|string $singer */
    protected $singer;
    /** @var null|PlaylistModel $playlist */
    protected $playlist;
    /** @var null|TrackModel $track */
    protected $track;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSinger(): ?string
    {
        return $this->singer;
    }

    /**
     * @param string|null $singer
     * @return self
     */
    public function setSinger(?string $singer): self
    {
        $this->singer = $singer;
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
     * @return TrackModel|null
     */
    public function getTrack(): ?TrackModel
    {
        return $this->track;
    }

    /**
     * @param TrackModel|null $track
     * @return self
     */
    public function setTrack(?TrackModel $track): self
    {
        $this->track = $track;
        return $this;
    }
}