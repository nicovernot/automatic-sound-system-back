<?php


namespace App\Model;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class PlaylistModel extends AbstractModel
{
    /** @var bool $archived */
    protected $archived;
    /** @var null|UserModel $user */
    protected $user;
    /** @var null|int $scoreMax */
    protected $scoreMax;
    /** @var null|string $name */
    protected $name;
    /** @var ResultModel[] $results */
    protected $results;

    public function __construct()
    {
        parent::__construct();

        $this->archived = false;
        $this->results = new ArrayCollection();
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @param bool $archived
     * @return self
     */
    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;
        return $this;
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ResultModel[]|ArrayCollection
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    public function addResult(ResultModel $resultModel): self
    {
        if (!$this->results->contains($resultModel)) {
            $this->results->add($resultModel);

            $resultModel->setPlaylist($this);
        }

        return $this;
    }

    public function removeResult(ResultModel $resultModel): self
    {
        if ($this->results->contains($resultModel)) {
            $this->results->removeElement($resultModel);

            $resultModel->setPlaylist(null);
        }

        return $this;
    }
}