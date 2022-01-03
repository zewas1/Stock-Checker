<?php

declare(strict_types=1);

namespace App\SaveHandler;

use App\Entity\StockInformation as Stock;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class StockSaveHandler
{
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @throws OptimisticLockException|ORMException
     */
    public function save(Stock $stock)
    {
        try {
            $this->em->persist($stock);
            $this->em->flush();
        } catch (OptimisticLockException $e) {
            $this->em->rollback();

            throw $e;
        }
    }
}