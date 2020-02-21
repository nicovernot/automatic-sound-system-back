<?php

namespace App\Controller\API;


use App\Entity\User;
use App\Service\Traits\DynamicFunctionCallTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

/**
 * Class AbstractController
 * @package App\Controller\API
 *
 * @method User|null getUser(): ?UserInterface
 * @method Request getCurrentRequest(): Request
 * @method mixed get(string $key)
 */
abstract class AbstractController
{
    use DynamicFunctionCallTrait;

    /** @var RequestStack $requestStack */
    protected $requestStack;
    /** @var Security $security */
    protected $security;

    //region AUTO WIRING

    /**
     * @param RequestStack $requestStack
     * @required
     */
    public function setRequestStack(RequestStack $requestStack): void
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param Security $security
     * @required
     */
    public function setSecurity(Security $security): void
    {
        $this->security = $security;
    }
    //endregion

    /**
     * @return RequestStack
     */
    public function getRequestStack(): RequestStack
    {
        return $this->requestStack;
    }

    /**
     * @return Security
     */
    public function getSecurity(): Security
    {
        return $this->security;
    }

    function setMapDynamicFunctions(): void
    {
        $this
            ->addDynamicFunction('getUser', [$this, 'getSecurity'])
            ->addDynamicFunction('getCurrentRequest', [$this, 'getRequestStack'])
            ->addDynamicFunction('get', [$this, 'getCurrentRequest']);
    }

    abstract public function getEntityClassName(): string;
}