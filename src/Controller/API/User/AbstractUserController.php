<?php

namespace App\Controller\API\User;


use App\Controller\API\AbstractController;
use App\Service\Entity\UserService;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

abstract class AbstractUserController extends AbstractController
{
    protected $service;

    public function __construct(Security $security, RequestStack $requestStack, UserService $userService)
    {
        $this->service  = $userService;

        parent::__construct($security, $requestStack);
    }
}