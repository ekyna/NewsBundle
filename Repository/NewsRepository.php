<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Repository;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ekyna\Component\Resource\Doctrine\ORM\Repository\TranslatableRepository;
use Ekyna\Bundle\NewsBundle\Model\NewsInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class NewsRepository
 * @package Ekyna\Bundle\NewsBundle\Entity
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsRepository extends TranslatableRepository implements NewsRepositoryInterface
{
    /**
     * Returns the front news pager.
     */
    public function createFrontPager(int $currentPage, int $maxPerPage = 12): Pagerfanta
    {
        $qb = $this->getCollectionQueryBuilder();

        $query = $qb
            ->addOrderBy('n.date', 'desc')
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
            ->andWhere($qb->expr()->lte('n.date', ':today'))
            ->getQuery();

        $today = new DateTime();
        $today->setTime(23, 59, 59, 999999);
        $query
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Types::DATETIME_MUTABLE);

        $pager = new Pagerfanta(new QueryAdapter($query, true, false));

        return $pager
            ->setNormalizeOutOfRangePages(true)
            ->setMaxPerPage($maxPerPage)
            ->setCurrentPage($currentPage);
    }

    /**
     * Finds one news by slug.
     */
    public function findOneBySlug(string $slug): ?NewsInterface
    {
        if (0 == strlen($slug)) {
            return null;
        }

        $today = new DateTime();
        $today->setTime(23, 59, 59, 999999);

        $qb = $this->getQueryBuilder();
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
     * @return Paginator
     */
    public function findLatest(int $limit = 3): Paginator
    {
        $today = new DateTime();
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

    protected function getAlias(): string
    {
        return 'n';
    }
}
