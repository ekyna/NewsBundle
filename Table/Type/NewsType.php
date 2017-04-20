<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Action\DeleteAction;
use Ekyna\Bundle\AdminBundle\Action\UpdateAction;
use Ekyna\Bundle\ResourceBundle\Table\Type\AbstractResourceType;
use Ekyna\Bundle\TableBundle\Extension\Type as BType;
use Ekyna\Component\Table\Extension\Core\Type as CType;
use Ekyna\Component\Table\TableBuilderInterface;
use Ekyna\Component\Table\Util\ColumnSort;

use function Symfony\Component\Translation\t;

/**
 * Class NewsType
 * @package Ekyna\Bundle\NewsBundle\Table\Type
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsType extends AbstractResourceType
{
    public function buildTable(TableBuilderInterface $builder, array $options): void
    {
        $builder
            ->addDefaultSort('date', ColumnSort::DESC)
            ->addColumn('name', BType\Column\AnchorType::class, [
                'label' => t('field.name', [], 'EkynaUi'),
            ])
            ->addColumn('date', CType\Column\DateTimeType::class, [
                'label'       => t('field.date', [], 'EkynaUi'),
                'time_format' => 'none',
            ])
            ->addColumn('enabled', CType\Column\BooleanType::class, [
                'label' => t('field.enabled', [], 'EkynaUi'),
            ])
            ->addColumn('actions', BType\Column\ActionsType::class, [
                'resource' => $this->dataClass,
                'actions'  => [
                    UpdateAction::class,
                    DeleteAction::class,
                ],
            ]);
    }
}
