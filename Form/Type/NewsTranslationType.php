<?php

namespace Ekyna\Bundle\NewsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class NewsTranslationType
 * @package AppBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NewsTranslationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', [
                'label' => 'ekyna_core.field.title',
            ])
            ->add('content', 'tinymce', [
                'label' => 'ekyna_core.field.content',
                'required' => false,
                'theme' => 'advanced',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => 'Ekyna\Bundle\NewsBundle\Entity\NewsTranslation',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_news_news_translation';
    }
}
