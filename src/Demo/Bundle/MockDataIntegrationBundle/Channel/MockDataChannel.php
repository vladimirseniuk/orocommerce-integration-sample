<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Channel;

use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;

/**
* Defining channel is a way to split on groups transport and connectors by third party application type.
 */
class MockDataChannel implements ChannelInterface
{
    const TYPE = 'demo_mock_data_channel';

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'demo.mock_data_integration.channel_type.label';
    }
}
