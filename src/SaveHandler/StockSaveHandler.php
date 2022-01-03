<?php

declare(strict_types=1);

namespace App\SaveHandler;

use App\Entity\StockInformation as Stock;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class StockSaveHandler
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
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