<?php

namespace Ekyna\Bundle\NewsBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class NewsType
 * @package AppBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NewsType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'ekyna_core.field.name',
            ])
            ->add('translations', 'a2lix_translationsForms', [
                'form_type' => new NewsTranslationType(),
                'label'     => false,
                'attr' => [
                    'widget_col' => 12,
                ],
            ])
            ->add('date', 'datetime', [
                'label' => 'ekyna_core.field.date',
            ])
            ->add('enabled', 'checkbox', [
                'label' => 'ekyna_core.field.enabled',
                'required' => false,
                'attr' => [
                    'align_with_widget' => true
                ],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_news_news';
    }
}
