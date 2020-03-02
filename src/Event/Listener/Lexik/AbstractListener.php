<?php


namespace App\Event\Listener\Lexik;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractListener
{
    /** @var TranslatorInterface $translator */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    abstract protected function getTranslationTitle(): string;
    abstract protected function getTranslationParams(): array;

    public function getMessage(): string
    {
        return $this->translator->trans(
            $this->getTranslationTitle(),
            $this->getTranslationParams(),
            'lexik'
        );
    }
}