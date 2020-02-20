<?php


namespace App\Model;


class TrackModel extends AbstractModel
{
    /** @var null|string $YTTitle */
    protected $YTTitle;
    /** @var null|string $thumbnails */
    protected $thumbnails;
    /** @var null|string $YTUrlId */
    protected $YTUrlId;

    /**
     * @return string|null
     */
    public function getYTTitle(): ?string
    {
        return $this->YTTitle;
    }

    /**
     * @param string|null $YTTitle
     * @return self
     */
    public function setYTTitle(?string $YTTitle): self
    {
        $this->YTTitle = $YTTitle;
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
        return $this->YTUrlId;
    }

    /**
     * @param string|null $YTUrlId
     * @return self
     */
    public function setYTUrlId(?string $YTUrlId): self
    {
        $this->YTUrlId = $YTUrlId;
        return $this;
    }
}