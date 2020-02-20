<?php


namespace App\Controller\API\Chat;


use App\Entity\Chat;

class PostChatController extends AbstractChatController
{
    public function __invoke(Chat $data)
    {
        $data->setUser($this->getUser());

        $this->service->persistAndFlush($data);

        return $data;
    }
}