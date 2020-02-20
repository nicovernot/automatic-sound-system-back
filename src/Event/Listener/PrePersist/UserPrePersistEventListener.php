<?php

namespace App\Event\Listener\PrePersist;


use App\Entity\User;
use App\Event\Listener\AbstractEntityEventListener;
use App\Service\Entity\User\UserAuthenticationService;
use App\Service\Entity\UserService;

class UserPrePersistEventListener extends AbstractEntityEventListener
{
    use PrePersistEventListenerTrait;

    /** @var UserService $userService */
    private $userService;

    public function __construct()
    {
        parent::__construct(User::class);
    }

    //region AUTO WIRING
    /**
     * @param UserService $userService
     * @required
     */
    public function setUserService(UserService $userService)
    {
        $this->userService = $userService;
    }
    //endregion

    protected function isValidEntity($object): bool
    {
        return $object instanceof User;
    }

    /** @var User $entity */
    protected function process($entity): void
    {
        $this->userService->encodeUserPassword($entity);
    }
}