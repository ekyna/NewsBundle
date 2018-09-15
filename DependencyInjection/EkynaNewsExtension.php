<?php

namespace Ekyna\Bundle\NewsBundle\DependencyInjection;

use Ekyna\Bundle\ResourceBundle\DependencyInjection\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class EkynaNewsExtension
 * @package Ekyna\Bundle\NewsBundle\DependencyInjection
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaNewsExtension extends AbstractExtension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->configure($configs, 'ekyna_news', new Configuration(), $container);
    }
}
