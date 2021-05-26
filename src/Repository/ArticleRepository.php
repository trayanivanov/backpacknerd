<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
    * @return Article[]
    */
    public function findSimilar(Article $article, int $limit = 2): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id != :articleId')
            ->andWhere('a.articleCategory = :articleCategory')
            ->andWhere('a.active = :active')
            ->setParameter('articleId', $article->getId())
            ->setParameter('articleCategory', $article->getArticleCategory())
            ->setParameter('active', true)
            ->orderBy('RAND()')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }
}
