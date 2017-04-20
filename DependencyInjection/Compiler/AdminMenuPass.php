<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\DependencyInjection\Compiler;

use \Ekyna\Bundle\CmsBundle\DependencyInjection\Compiler\AdminMenuPass as CmsPass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AdminMenuPass
 * @package Ekyna\Bundle\NewsBundle\DependencyInjection\Compiler
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class AdminMenuPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $pool = $container->getDefinition('ekyna_admin.menu.pool');

        $pool->addMethodCall('createGroup', [CmsPass::GROUP]);

        $pool->addMethodCall('createEntry', [
            'content',
            [
                'name'     => 'news',
                'resource' => 'ekyna_news.news',
                'position' => 50,
            ],
        ]);
    }
}
