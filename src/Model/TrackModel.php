<?php


namespace App\Model;


class TrackModel extends AbstractModel
{
    /** @var null|string $yTTitle */
    protected $yTTitle;
    /** @var null|string $thumbnails */
    protected $thumbnails;
    /** @var null|string $yTUrlId */
    protected $yTUrlId;

    /**
     * @return string|null
     */
    public function getYTTitle(): ?string
    {
        return $this->yTTitle;
    }

    /**
     * @param string|null $yTTitle
     * @return self
     */
    public function setYTTitle(?string $yTTitle): self
    {
        $this->yTTitle = $yTTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getThumbnails(): ?string
    {
        return $this->thumbnails;
    }

    /**
     * @param string|null $thumbnails
     * @return self
     */
    public function setThumbnails(?string $thumbnails): self
    {
        $this->thumbnails = $thumbnails;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getYTUrlId(): ?string
    {
        return $this->yTUrlId;
    }

    /**
     * @param string|null $yTUrlId
     * @return self
     */
    public function setYTUrlId(?string $yTUrlId): self
    {
        $this->yTUrlId = $yTUrlId;
        return $this;
    }
}