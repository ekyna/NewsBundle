<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle;

use Ekyna\Bundle\NewsBundle\DependencyInjection\Compiler\AdminMenuPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class EkynaNewsBundle
 * @package Ekyna\Bundle\NewsBundle
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaNewsBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new AdminMenuPass());
    }
}
