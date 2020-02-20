<?php

namespace App\Event\Listener;


use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

trait EventListenerTrait
{
    abstract protected function isValidEntity($object): bool;
    abstract protected function process($entity): void;

    public function handle(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$this->isValidEntity($entity)) {
            return;
        }

        $this->process($entity);
    }
}