<?php

namespace Ekyna\Bundle\NewsBundle\Form\Type;

use Ekyna\Bundle\CoreBundle\Form\Type\TinymceType;
use Ekyna\Bundle\NewsBundle\Entity\NewsTranslation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class NewsTranslationType
 * @package AppBundle\Form\Type
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsTranslationType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'        => 'ekyna_core.field.title',
                'admin_helper' => 'NEWS_NEWS_TRANSLATION_TITLE',
            ])
            ->add('content', TinymceType::class, [
                'label'        => 'ekyna_core.field.content',
                'theme'        => 'advanced',
                'required'     => false,
                'admin_helper' => 'NEWS_NEWS_TRANSLATION_CONTENT',
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewsTranslation::class,
        ]);
    }
}
