<?php

namespace App\Service\Base;


use App\Service\Interfaces\ServiceInterface;
use App\Service\Traits\DynamicFunctionCallTrait;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method object|null find($id, $lockMode = null, $lockVersion = null)
 * @method object|null findOneBy(array $criteria, array $orderBy = null)
 * @method object[]    findAll()
 * @method object[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @method object[] count(array $criteria)
 *
 * @method void persist($entity): void
 * @method void flush(): void
 */
abstract class AbstractEntityService implements ServiceInterface
{
    use DynamicFunctionCallTrait;

    /** @var EntityManagerInterface $entityManager */
    private $entityManager;

    /** @var ObjectRepository $repository */
    private $repository;

    protected function setMapDynamicFunctions(): void
    {
        $this
            ->addDynamicFunction('find', [$this, 'getRepository'])
            ->addDynamicFunction('findOneBy', [$this, 'getRepository'])
            ->addDynamicFunction('findAll', [$this, 'getRepository'])
            ->addDynamicFunction('findBy', [$this, 'getRepository'])
            ->addDynamicFunction('count', [$this, 'getRepository'])
            ->addDynamicFunction('persist', [$this, 'getEntityManager'])
            ->addDynamicFunction('flush', [$this, 'getEntityManager'])
        ;
    }

    //region AUTOWIRING
    /** @required */
    public function setEntityManager(EntityManagerInterface $entityManager): self
    {
        $this->entityManager = $entityManager;

        return $this;
    }
    //endregion

    //region GETTERS
    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
    //endregion

    //region REPOSITORY
    public function getRepository(): ObjectRepository
    {
        if ($this->repository === null) {
            $this->setRepository();
        }

        return $this->repository;
    }

    public function setRepository(): self
    {
        $this->repository = $this->getEntityManager()->getRepository($this->getEntityClassName());

        return $this;
    }

    public function isTableEmpty(): bool
    {
        return $this->count([]) === 0;
    }
    //endregion

    //region ENTITY MANAGER
    protected function persists(array $entities): self
    {
        foreach ($entities as $entity) {
            $this->persist($entity);
        }

        return $this;
    }

    public function persistAndFlush($entity): self
    {
        $this->persist($entity);
        $this->flush();

        return $this;
    }

    public function persistsAndFlush($entities): self
    {
        $this->persists($entities);
        $this->flush();

        return $this;
    }

    public function clear(): self
    {
        $this->getEntityManager()->clear($this->getEntityClassName());

        return $this;
    }
    //endregion
}