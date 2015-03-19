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
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'ekyna_core.field.name',
            ))
            ->add('title', 'text', array(
                'label' => 'ekyna_core.field.title',
            ))
            ->add('date', 'datetime', array(
                'label' => 'ekyna_core.field.date',
            ))
            ->add('content', 'textarea', array(
                'label' => 'ekyna_core.field.content',
                'attr' => array(
                    'class' => 'tinymce',
                    'data-theme' => 'advanced',
                )
            ))
            ->add('private', 'checkbox', array(
                'label' => 'ekyna_core.field.private',
                'required' => false,
                'attr' => array(
                    'align_with_widget' => true
                ),
            ))
            ->add('enabled', 'checkbox', array(
                'label' => 'ekyna_core.field.enabled',
                'required' => false,
                'attr' => array(
                    'align_with_widget' => true
                ),
            ))
            ->add('seo', 'ekyna_cms_seo')
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
