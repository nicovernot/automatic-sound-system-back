<?php


namespace App\Model;


class ChatModel extends AbstractModel
{
    /** @var null|UserModel $user */
    protected $user;
    /** @var null|string $message */
    protected $message;

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
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return self
     */
    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }
}