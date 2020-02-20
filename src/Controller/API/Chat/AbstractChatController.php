<?php

namespace App\Controller\API\Chat;


use App\Controller\API\AbstractController;
use App\Entity\Chat;
use App\Service\Entity\ChatService;

abstract class AbstractChatController extends AbstractController
{
    /** @var ChatService $service */
    protected $service;

    /**
     * @param ChatService $service
     * @required
     */
    public function setService(ChatService $service): void
    {
        $this->service = $service;
    }

    public function getEntityClassName(): string
    {
        return Chat::class;
    }
}