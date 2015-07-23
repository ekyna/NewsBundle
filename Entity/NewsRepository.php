<?php

namespace Ekyna\Bundle\NewsBundle\Entity;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ekyna\Bundle\AdminBundle\Doctrine\ORM\TranslatableResourceRepository;
use Ekyna\Bundle\NewsBundle\Model\NewsInterface;

/**
 * Class NewsRepository
 * @package Ekyna\Bundle\NewsBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NewsRepository extends TranslatableResourceRepository
{
    /**
     * {@inheritdoc}
     */
    public function createPager(array $criteria = array(), array $sorting = array())
    {
        $qb = $this->getCollectionQueryBuilder();

        $this->applyCriteria($qb, $criteria);
        $this->applySorting($qb, $sorting);

        $today = new \DateTime();
        $today->setTime(23,59,59);
        $qb
            ->andWhere($qb->expr()->lte('n.date', ':today'))
            ->setParameter('today', $today, Type::DATETIME)
        ;

        return $this->getPager($qb);
    }

    /**
     * Finds one news by slug.
     *
     * @param string $slug
     * @return NewsInterface|null
     */
    public function findOneBySlug($slug)
    {
        if (0 == strlen($slug)) {
            return null;
        }

        $today = new \DateTime();
        $today->setTime(23,59,59);

        $qb = $this->getQueryBuilder();
        $query = $qb
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
            ->andWhere($qb->expr()->eq('translation.slug', ':slug'))
            ->andWhere($qb->expr()->lte('n.date', ':today'))
            ->addOrderBy('n.date', 'DESC')
            ->getQuery()
        ;

        return $query
            ->setParameter('enabled', true)
            ->setParameter('slug', $slug)
            ->setParameter('today', $today, Type::DATETIME)
            ->getOneOrNullResult()
        ;
    }

    /**
     * Finds the latest news.
     *
     * @param int $limit
     * @return Paginator|NewsInterface[]
     */
    public function findLatest($limit = 3)
    {
        $today = new \DateTime();
        $today->setTime(23,59,59);

        $qb = $this->getCollectionQueryBuilder();
        $qb
            ->andWhere($qb->expr()->eq('n.enabled', ':enabled'))
            ->andWhere($qb->expr()->lte('n.date', ':today'))
            ->addOrderBy('n.date', 'DESC')
            ->setMaxResults($limit)
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Type::DATETIME)
            ->getQuery()
        ;

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
