<?php

namespace App\Repository;

use App\Entity\Chat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Chat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chat[]    findAll()
 * @method Chat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chat::class);
    }

    public function findForLoad(): array
    {
        $queryBuilder = $this->createQueryBuilder('chat');

        $queryBuilder->setMaxResults(5);

        $query = $queryBuilder->getQuery();
        $result = $query->getResult();

        return $result;
    }

    public function findAfter(\DateTime $dateTime): array
    {
        $queryBuilder = $this->createQueryBuilder('chat');
        $expr = $queryBuilder->expr();

        $str = $dateTime->format('Y/m/d H:i:s');

        $queryBuilder
            ->where($expr->gt('chat.createdAt', ':after'))
            ->setParameter('after', $str)
        ;

        $query = $queryBuilder->getQuery();
        $result = $query->getResult();

        return $result;
    }
}
