<?php

namespace App\Repository;

use App\Entity\ArticleMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleMedia[]    findAll()
 * @method ArticleMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleMedia::class);
    }
}
