<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Form\Type;

use Ekyna\Bundle\NewsBundle\Entity\NewsTranslation;
use Ekyna\Bundle\UiBundle\Form\Type\TinymceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use function Symfony\Component\Translation\t;

/**
 * Class NewsTranslationType
 * @package AppBundle\Form\Type
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'        => t('field.title', [], 'EkynaUi'),
                'admin_helper' => 'NEWS_NEWS_TRANSLATION_TITLE',
            ])
            ->add('content', TinymceType::class, [
                'label'        => t('field.content', [], 'EkynaUi'),
                'theme'        => 'advanced',
                'required'     => false,
                'admin_helper' => 'NEWS_NEWS_TRANSLATION_CONTENT',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsTranslation::class,
        ]);
    }
}
