<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Form\Type;

use A2lix\TranslationFormBundle\Form\Type\TranslationsFormsType;
use Ekyna\Bundle\CmsBundle\Form\Type\SeoType;
use Ekyna\Bundle\MediaBundle\Form\Type\MediaChoiceType;
use Ekyna\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;

use function Symfony\Component\Translation\t;

/**
 * Class NewsType
 * @package AppBundle\Form\Type
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', Type\TextType::class, [
                'label' => t('field.name', [], 'EkynaUi'),
            ])
            ->add('date', Type\DateTimeType::class, [
                'label' => t('field.date', [], 'EkynaUi'),
            ])
            ->add('enabled', Type\CheckboxType::class, [
                'label'    => t('field.enabled', [], 'EkynaUi'),
                'required' => false,
                'attr'     => [
                    'align_with_widget' => true,
                ],
            ])
            ->add('translations', TranslationsFormsType::class, [
                'form_type'      => NewsTranslationType::class,
                'label'          => false,
                'error_bubbling' => false,
                'attr'           => [
                    'widget_col' => 12,
                ],
            ])
            ->add('media', MediaChoiceType::class)
            ->add('seo', SeoType::class);
    }
}
