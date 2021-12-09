<?php

namespace App\Repository;

use App\Entity\StockInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StockInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockInformation[]    findAll()
 * @method StockInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockInformation::class);
    }
}
