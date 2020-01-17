<?php

namespace Ekyna\Bundle\NewsBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ekyna\Bundle\NewsBundle\Model\NewsInterface;
use Ekyna\Component\Resource\Doctrine\ORM\TranslatableResourceRepository;

/**
 * Class NewsRepository
 * @package Ekyna\Bundle\NewsBundle\Entity
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsRepository extends TranslatableResourceRepository
{
    /**
     * Returns the front news pager.
     *
     * @param integer $currentPage
     * @param integer $maxPerPage
     *
     * @return \Pagerfanta\Pagerfanta
     */
    public function createFrontPager($currentPage, $maxPerPage = 12)
    {
        $qb = $this->getCollectionQueryBuilder();

        $query = $qb
            ->addOrderBy('n.date', 'desc')
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
            ->andWhere($qb->expr()->lte('n.date', ':today'))
            ->getQuery();

        $today = new \DateTime();
        $today->setTime(23, 59, 59, 999999);
        $query
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Types::DATETIME_MUTABLE);

        return $this
            ->getPager($query)
            ->setNormalizeOutOfRangePages(true)
            ->setMaxPerPage($maxPerPage)
            ->setCurrentPage($currentPage);
    }

    /**
     * Finds one news by slug.
     *
     * @param string $slug
     *
     * @return NewsInterface|null
     */
    public function findOneBySlug($slug)
    {
        if (0 == strlen($slug)) {
            return null;
        }

        $today = new \DateTime();
        $today->setTime(23, 59, 59, 999999);

        $qb    = $this->getQueryBuilder();
        $query = $qb
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
            ->andWhere($qb->expr()->eq('translation.slug', ':slug'))
            ->andWhere($qb->expr()->lte('n.date', ':today'))
            ->addOrderBy('n.date', 'DESC')
            ->getQuery();

        return $query
            ->setParameter('enabled', true)
            ->setParameter('slug', $slug)
            ->setParameter('today', $today, Types::DATETIME_MUTABLE)
            ->getOneOrNullResult();
    }

    /**
     * Finds the latest news.
     *
     * @param int $limit
     *
     * @return Paginator|NewsInterface[]
     */
    public function findLatest($limit = 3)
    {
        $today = new \DateTime();
        $today->setTime(23, 59, 59, 999999);

        $qb = $this->getCollectionQueryBuilder();
        $qb
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
            ->andWhere($qb->expr()->lte('n.date', ':today'))
            ->addOrderBy('n.date', 'DESC')
            ->setMaxResults($limit)
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Types::DATETIME_MUTABLE)
            ->getQuery();

        return new Paginator($qb->getQuery(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'n';
    }
}
