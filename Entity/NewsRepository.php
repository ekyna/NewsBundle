<?php

namespace Ekyna\Bundle\NewsBundle\Entity;

use Doctrine\DBAL\Types\Type;
use Ekyna\Bundle\AdminBundle\Doctrine\ORM\ResourceRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class NewsRepository
 * @package Ekyna\Bundle\NewsBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NewsRepository extends ResourceRepository
{
    /**
     * Returns the news pager.
     *
     * @param integer $currentPage
     * @param integer $maxPerPage
     * @param bool    $includePrivate
     * @return Pagerfanta
     */
    public function createPager($currentPage, $maxPerPage = 12, $includePrivate = false)
    {
        $qb = $this->createQueryBuilder('n');
        $params = ['enabled' => true];
        $qb
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
            ->addOrderBy('n.date', 'DESC')
        ;
        if (!$includePrivate) {
            $qb->andWhere($qb->expr()->eq('n.private', ':private'));
            $params['private'] = false;
        }

        $query = $qb->getQuery();
        $query->setParameters($params);

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager
            ->setNormalizeOutOfRangePages(true)
            ->setMaxPerPage($maxPerPage)
            ->setCurrentPage($currentPage)
        ;

        return $pager;
    }

    /**
     * Finds one news by slug.
     *
     * @param string $slug
     * @return News|null
     */
    public function findOneBySlug($slug)
    {
        if (0 == strlen($slug)) {
            return null;
        }

        $qb = $this->createQueryBuilder('n');
        $query = $qb
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
            ->andWhere($qb->expr()->eq('n.slug',    ':slug'))
            ->getQuery()
        ;

        return $query
            ->setMaxResults(1)
            ->setParameters(array(
                'enabled' => true,
                'slug' => $slug,
            ))
            ->getOneOrNullResult()
        ;
    }

    /**
     * Finds the latest news.
     *
     * @param int $limit
     * @return News[]
     */
    public function findLatest($limit = 3)
    {
        $today = new \DateTime();
        $today->setTime(23,59,59);

        $qb = $this->createQueryBuilder('n');
        $query = $qb
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
            ->andWhere($qb->expr()->lte('n.date', ':today'))
            ->addOrderBy('n.date', 'DESC')
            ->getQuery()
        ;

        return $query
            ->setMaxResults($limit)
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Type::DATETIME)
            ->getResult()
        ;
    }
}
