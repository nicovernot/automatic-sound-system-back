<?php


namespace App\Model;


abstract class AbstractUpdatableModel extends AbstractModel
{
    /** @var null|\DateTime $updatedAt */
    protected $updatedAt;

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     * @return self
     */
    public function setUpdatedAt(?\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}