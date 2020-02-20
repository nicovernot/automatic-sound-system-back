<?php


namespace App\Service\Entity;


use App\Entity\User;
use App\Service\Base\AbstractEntityService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserService extends AbstractEntityService
{
    /** @var UserPasswordEncoderInterface $encoder */
    protected $encoder;
    /** @var SerializerInterface $serializer */
    protected $serializer;

    //region AUTO WIRING
    /**
     * @param UserPasswordEncoderInterface $encoder
     * @required
     */
    public function setEncoder(UserPasswordEncoderInterface $encoder): void
    {
        $this->encoder = $encoder;
    }

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
        return User::class;
    }

    public function createFromRequest(Request $request): User
    {
        $user = $this->serializer->deserialize(
            $request->getContent(),
            User::class,
            'json'
        );

        return $user;
    }

    public function add(User $user): bool
    {
        if (!$this->count(['email' => $user->getEmail()])) {
            $this->persistAndFlush($user);
        }

        return $user->getId() !== null;
    }

    public function encodeUserPassword(User $user): void
    {
        $user
            ->setPassword($this->encoder->encodePassword($user, $user->getPlainPassword()))
            ->setPlainPassword(null);
    }
}