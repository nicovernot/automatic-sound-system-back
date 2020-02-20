<?php


namespace App\Controller\API\Chat;


class LoadChatController extends AbstractChatController
{
    public function __invoke()
    {
        $afterDateTime = $this->get('after');

        $chats = null;

        if ($afterDateTime !== null) {
            $dateTime = new \DateTime($afterDateTime);

            $chats = $this->service->findAfter($dateTime);
        } else {
            $chats = $this->service->findForLoad();
        }

        return $chats;
    }
}