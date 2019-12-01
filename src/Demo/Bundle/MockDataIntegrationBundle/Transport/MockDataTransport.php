<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Transport;

use Demo\Bundle\MockDataIntegrationBundle\Entity\MockDataSettings;
use Demo\Bundle\MockDataIntegrationBundle\Form\Type\MockDataSettingsType;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;

/**
 * The way to read the data from your external application.
 */
class MockDataTransport implements TransportInterface
{
    /**
     * {@inheritdoc}
     */
    public function init(Transport $transportEntity)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'demo.mock_data_integration.transport.label';
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsFormType()
    {
        return MockDataSettingsType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsEntityFQCN()
    {
        return MockDataSettings::class;
    }
}
