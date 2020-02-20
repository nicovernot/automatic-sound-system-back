<?php


namespace App\Service\Entity;


use App\Entity\Chat;
use App\Repository\ChatRepository;
use App\Service\Base\AbstractEntityService;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ChatService
 * @package App\Service\Entity
 *
 * @method ChatRepository   getRepository() : ObjectRepository
 * @method Chat[]           findForLoad() : Chat[]
 * @method Chat[]           findAfter(\DateTime $dateTime) : Chat[]
 */
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

    protected function setMapDynamicFunctions(): void
    {
        parent::setMapDynamicFunctions();

        $this
            ->addDynamicFunction('findForLoad', [$this, 'getRepository'])
            ->addDynamicFunction('findAfter', [$this, 'getRepository'])
        ;
    }


}