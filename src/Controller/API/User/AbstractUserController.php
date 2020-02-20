<?php

namespace App\Controller\API\User;


use App\Controller\API\AbstractController;
use App\Entity\User;
use App\Service\Entity\UserService;

abstract class AbstractUserController extends AbstractController
{
    /** @var UserService $service */
    protected $service;

    /**
     * @param UserService $service
     * @required
     */
    public function setService(UserService $service): void
    {
        $this->service = $service;
    }

    public function getEntityClassName(): string
    {
        return User::class;
    }
}