<?php

namespace App\Event\Listener\PrePersist;


use App\Event\Listener\EventListenerTrait;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

trait PrePersistEventListenerTrait
{
    use EventListenerTrait;

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->handle($args);
    }
}