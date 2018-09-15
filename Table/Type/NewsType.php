<?php

namespace Ekyna\Bundle\NewsBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Bundle\TableBundle\Extension\Type as BType;
use Ekyna\Component\Table\Extension\Core\Type as CType;
use Ekyna\Component\Table\TableBuilderInterface;
use Ekyna\Component\Table\Util\ColumnSort;

/**
 * Class NewsType
 * @package Ekyna\Bundle\NewsBundle\Table\Type
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsType extends ResourceTableType
{
    /**
     * @inheritdoc
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addDefaultSort('date', ColumnSort::DESC)
            ->addColumn('name', BType\Column\AnchorType::class, [
                'label'                => 'ekyna_core.field.name',
                'route_name'           => 'ekyna_news_news_admin_show',
                'route_parameters_map' => [
                    'newsId' => 'id',
                ],
            ])
            ->addColumn('date', CType\Column\DateTimeType::class, [
                'label'       => 'ekyna_core.field.date',
                'time_format' => 'none',
            ])
            ->addColumn('enabled', CType\Column\BooleanType::class, [
                'label'                => 'ekyna_core.field.enabled',
                'route_name'           => 'ekyna_news_news_admin_toggle',
                'route_parameters'     => ['field' => 'enabled'],
                'route_parameters_map' => ['newsId' => 'id'],
            ])
            ->addColumn('actions', BType\Column\ActionsType::class, [
                'buttons' => [
                    [
                        'label'                => 'ekyna_core.button.edit',
                        'icon'                 => 'pencil',
                        'class'                => 'warning',
                        'route_name'           => 'ekyna_news_news_admin_edit',
                        'route_parameters_map' => [
                            'newsId' => 'id',
                        ],
                        'permission'           => 'edit',
                    ],
                    [
                        'label'                => 'ekyna_core.button.remove',
                        'icon'                 => 'trash',
                        'class'                => 'danger',
                        'route_name'           => 'ekyna_news_news_admin_remove',
                        'route_parameters_map' => [
                            'newsId' => 'id',
                        ],
                        'permission'           => 'delete',
                    ],
                ],
            ]);
    }
}
