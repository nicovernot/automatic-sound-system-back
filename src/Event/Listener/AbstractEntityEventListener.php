<?php

namespace App\Event\Listener;

abstract class AbstractEntityEventListener
{
    /** @var string $entityClassName */
    private $entityClassName;

    public function __construct(string $entityClassName)
    {
        $this->entityClassName = $entityClassName;
    }

    protected function isInstanceOfEntity($object): bool
    {
        return $object instanceof $this->entityClassName;
    }
}