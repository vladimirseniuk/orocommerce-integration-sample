<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Transport;

use Demo\Bundle\MockDataIntegrationBundle\Entity\MockDataSettings;
use Demo\Bundle\MockDataIntegrationBundle\Form\Type\MockDataSettingsType;
use Oro\Bundle\IntegrationBundle\Provider\Rest\Transport\AbstractRestTransport;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * The way to read the data from your external application.
 */
class MockDataTransport extends AbstractRestTransport
{
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

    /**
     * {@inheritdoc}
     */
    protected function getClientBaseUrl(ParameterBag $parameterBag)
    {
        return rtrim($parameterBag->get('api_url'), '/') . '/';
    }

    /**
     * {@inheritdoc}
     */
    protected function getClientOptions(ParameterBag $parameterBag)
    {
        return [];
    }
}
