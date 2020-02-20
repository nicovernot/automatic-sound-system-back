<?php


namespace App\Model;


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

    public function __construct()
    {
        parent::__construct();

        $this->archived = false;
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
}