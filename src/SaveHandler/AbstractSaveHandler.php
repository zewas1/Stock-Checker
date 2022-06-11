<?php

declare(strict_types=1);

namespace App\SaveHandler;

use Doctrine\ORM\EntityManagerInterface;

class AbstractSaveHandler
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
     * @param $entity
     */
    public function save($entity): void
    {
        $this->em->persist($entity);
        $this->em->flush($entity);
    }
}