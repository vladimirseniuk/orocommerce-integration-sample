<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Connector;

use Demo\Bundle\MockDataIntegrationBundle\Transport\MockDataTransport;
use Oro\Bundle\IntegrationBundle\Provider\AbstractConnector;
use Oro\Bundle\ProductBundle\Entity\Product;

/**
 * Connects data with Product entity using Import/Export logic.
 *
 * @property MockDataTransport $transport
 */
class ProductConnector extends AbstractConnector
{
    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'demo.mock_data_integration.connector.product.label';
    }

    /**
     * {@inheritdoc}
     */
    public function getImportEntityFQCN()
    {
        return Product::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getImportJobName()
    {
        return 'mock_data_import_products';
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    protected function getConnectorSource()
    {
        return $this->transport->getProducts();
    }
}
