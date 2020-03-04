<?php


namespace App\Event\Listener\Lexik;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

class JWTExpiredListener extends AbstractListener
{
    protected function getTranslationTitle(): string
    {
        return 'jwt.expired';
    }

    protected function getTranslationParams(): array
    {
        return [];
    }

    /**
     * @param JWTExpiredEvent $event
     */
    public function handleEvent(JWTExpiredEvent $event)
    {
        /** @var JWTAuthenticationFailureResponse */
        $response = $event->getResponse();

        $response->setMessage($this->getMessage());
    }
}