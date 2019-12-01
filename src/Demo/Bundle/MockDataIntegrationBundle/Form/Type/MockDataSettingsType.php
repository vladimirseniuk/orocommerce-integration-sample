<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Form\Type;

use Demo\Bundle\MockDataIntegrationBundle\Entity\MockDataSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type that is used to let the user configure transport specific settings.
 */
class MockDataSettingsType extends AbstractType
{
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
