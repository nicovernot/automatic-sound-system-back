<?php


namespace App\Service\Entity;


use App\Entity\Chat;
use App\Service\Base\AbstractEntityService;
use Symfony\Component\Serializer\SerializerInterface;

class ChatService extends AbstractEntityService
{
    /** @var SerializerInterface $serializer */
    protected $serializer;

    //region AUTO WIRING
    /**
     * @param SerializerInterface $serializer
     * @required
     */
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }
    //endregion

    public function getEntityClassName(): string
    {
        return Chat::class;
    }
}