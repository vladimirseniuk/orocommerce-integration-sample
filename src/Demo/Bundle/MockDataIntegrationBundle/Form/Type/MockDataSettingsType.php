<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Form\Type;

use Demo\Bundle\MockDataIntegrationBundle\Entity\MockDataSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

/**
 * Form type that is used to let the user configure transport specific settings.
 */
class MockDataSettingsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('apiUrl', TextType::class, [
            'label' => 'demo.mock_data_integration.transport.api_url.label',
            'required'    => true,
            'constraints' => [
                new NotBlank(),
                new Url(),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MockDataSettings::class
        ]);
    }
}
