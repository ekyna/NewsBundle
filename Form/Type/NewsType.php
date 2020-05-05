<?php

namespace Ekyna\Bundle\NewsBundle\Form\Type;

use A2lix\TranslationFormBundle\Form\Type\TranslationsFormsType;
use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Ekyna\Bundle\CmsBundle\Form\Type\SeoType;
use Ekyna\Bundle\MediaBundle\Form\Type\MediaChoiceType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class NewsType
 * @package AppBundle\Form\Type
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsType extends ResourceFormType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', Type\TextType::class, [
                'label' => 'ekyna_core.field.name',
            ])
            ->add('date', Type\DateTimeType::class, [
                'label'  => 'ekyna_core.field.date',
                'format' => 'dd/MM/yyyy',
            ])
            ->add('enabled', Type\CheckboxType::class, [
                'label'    => 'ekyna_core.field.enabled',
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
