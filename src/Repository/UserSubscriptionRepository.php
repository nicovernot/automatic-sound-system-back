<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserSubscriptionRepository
 * @package App\Repository
 */
class UserSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSubscription::class);
    }

    /**
     * @param array $idList
     * @return mixed
     */
    public function findByIds(array $idList)
    {
        return $this->createQueryBuilder('us')
            ->select("us")
            ->innerJoin("us.user", "u")
            ->where('u.id in (:idList)')
            ->setParameter('idList', $idList)
            ->getQuery()
            ->getResult()
            ;
    }
}
