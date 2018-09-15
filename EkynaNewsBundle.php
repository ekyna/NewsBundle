<?php

namespace Ekyna\Bundle\NewsBundle;

use Ekyna\Bundle\NewsBundle\Model\NewsInterface;
use Ekyna\Bundle\ResourceBundle\AbstractBundle;
use Ekyna\Bundle\NewsBundle\DependencyInjection\Compiler\AdminMenuPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class EkynaNewsBundle
 * @package Ekyna\Bundle\NewsBundle
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaNewsBundle extends AbstractBundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AdminMenuPass());
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelInterfaces()
    {
        return [
            NewsInterface::class => 'ekyna_news.news.class',
        ];
    }
}
