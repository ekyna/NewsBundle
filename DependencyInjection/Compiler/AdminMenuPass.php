<?php

namespace Ekyna\Bundle\NewsBundle\DependencyInjection\Compiler;

use Ekyna\Bundle\AdminBundle\Menu\MenuPool;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AdminMenuPass
 * @package Ekyna\Bundle\NewsBundle\DependencyInjection\Compiler
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class AdminMenuPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(MenuPool::class)) {
            return;
        }

        $pool = $container->getDefinition(MenuPool::class);

        $pool->addMethodCall('createGroup', [[
            'name'     => 'content',
            'label'    => 'ekyna_core.field.content',
            'icon'     => 'paragraph',
            'position' => 20,
        ]]);
        $pool->addMethodCall('createEntry', ['content', [
            'name'     => 'news',
            'route'    => 'ekyna_news_news_admin_home',
            'label'    => 'ekyna_news.news.label.plural',
            'resource' => 'ekyna_news_news',
            'position' => 50,
        ]]);
    }
}
