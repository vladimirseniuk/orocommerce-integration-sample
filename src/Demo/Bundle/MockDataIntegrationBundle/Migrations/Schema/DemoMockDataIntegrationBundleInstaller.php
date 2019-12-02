<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class DemoMockDataIntegrationBundleInstaller implements Installation
{
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->addTransportColumns($schema);
    }

    /**
     * @param Schema $schema
     */
    public function addTransportColumns(Schema $schema)
    {
        $transportTable = $schema->getTable('oro_integration_transport');
        $transportTable->addColumn('mock_data_api_url', 'string', ['notnull' => false]);
    }
}
