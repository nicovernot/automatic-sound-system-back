<?php

namespace App\Controller\API\User;


class CurrentUserController extends AbstractUserController
{
    public function __invoke()
    {
        return $this->getUser();
    }
}