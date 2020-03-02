<?php


namespace App\Event\Listener\Lexik;


use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

class AuthenticationFailureListener extends AbstractListener
{
    protected function getTranslationTitle(): string
    {
        return 'auth.failure';
    }

    protected function getTranslationParams(): array
    {
        return [];
    }

    /**
     * @param AuthenticationFailureEvent $event
     */
    public function handleEvent(AuthenticationFailureEvent $event)
    {
        /** @var JWTAuthenticationFailureResponse */
        $response = $event->getResponse();

        $response->setMessage($this->getMessage());
    }
}