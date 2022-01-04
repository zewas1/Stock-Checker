<?php

declare(strict_types=1);

namespace App\SaveHandler;

use App\Entity\StockInformation as Stock;
use Doctrine\ORM\EntityManagerInterface;

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
     * @param Stock $stock
     */
    public function save(Stock $stock)
    {
        $this->em->persist($stock);
        $this->em->flush($stock);
    }
}