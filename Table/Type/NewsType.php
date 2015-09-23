<?php

namespace Ekyna\Bundle\NewsBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class NewsType
 * @package Ekyna\Bundle\NewsBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NewsType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('name', 'anchor', [
                'label' => 'ekyna_core.field.name',
                'route_name' => 'ekyna_news_news_admin_show',
                'route_parameters_map' => [
                    'newsId' => 'id'
                ],
            ])
            ->addColumn('date', 'datetime', [
                'label' => 'ekyna_core.field.date',
            ])
            ->addColumn('enabled', 'boolean', [
                'label' => 'ekyna_core.field.enabled',
                'sortable' => true,
                'route_name' => 'ekyna_news_news_admin_toggle',
                'route_parameters_map' => [
                    'newsId' => 'id',
                ],
            ])
            ->addColumn('actions', 'admin_actions', [
                'buttons' => [
                    [
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_news_news_admin_edit',
                        'route_parameters_map' => [
                            'newsId' => 'id'
                        ],
                        'permission' => 'edit',
                    ],
                    [
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_news_news_admin_remove',
                        'route_parameters_map' => [
                            'newsId' => 'id'
                        ],
                        'permission' => 'delete',
                    ],
                ],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'default_sorts' => ['date desc'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_news_news';
    }
}
