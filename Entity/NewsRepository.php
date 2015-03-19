<?php

namespace Ekyna\Bundle\NewsBundle\Entity;

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
     * Returns the pager.
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
            ->addOrderBy('n.date', 'DESC')
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
        ;
        if (!$includePrivate) {
            $qb->andWhere($qb->expr()->eq('n.private', ':private'));
            $params['private'] = false;
        }

        $qb->setParameters($params);

        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));
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
     * @param $slug
     * @return News|null
     */
    public function findOneBySlug($slug)
    {
        $qb = $this->createQueryBuilder('n');
        $qb
            ->andWhere($qb->expr()->eq('n.enabled', true))
            ->andWhere($qb->expr()->eq('n.slug', $qb->expr()->literal($slug)))
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
