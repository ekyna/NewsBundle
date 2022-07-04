<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Repository;

use Ekyna\Bundle\NewsBundle\Model\NewsInterface;
use Ekyna\Component\Resource\Repository\ResourceRepositoryInterface;
use Ekyna\Component\Resource\Repository\TranslatableRepositoryInterface;

/**
 * Interface NewsRepositoryInterface
 * @package Ekyna\Bundle\NewsBundle\Repository
 * @author  Étienne Dauvergne <contact@ekyna.com>
 *
 * @implements ResourceRepositoryInterface<NewsInterface>
 */
interface NewsRepositoryInterface extends TranslatableRepositoryInterface
{

}
