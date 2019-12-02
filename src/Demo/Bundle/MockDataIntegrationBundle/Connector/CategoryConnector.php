<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Connector;

use Demo\Bundle\MockDataIntegrationBundle\Transport\MockDataTransport;
use Oro\Bundle\CatalogBundle\Entity\Category;
use Oro\Bundle\IntegrationBundle\Provider\AbstractConnector;

/**
 * Connects data with Category entity using Import/Export logic.
 *
 * @property MockDataTransport $transport
 */
class CategoryConnector extends AbstractConnector
{
    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'demo.mock_data_integration.connector.category.label';
    }

    /**
     * {@inheritdoc}
     */
    public function getImportEntityFQCN()
    {
        return Category::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getImportJobName()
    {
        return 'mock_data_import_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    protected function getConnectorSource()
    {
        return $this->transport->getCategories();
    }
}
