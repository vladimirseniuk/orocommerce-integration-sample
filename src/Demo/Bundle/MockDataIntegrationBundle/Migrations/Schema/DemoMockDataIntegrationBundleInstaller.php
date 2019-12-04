<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
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
        $this->addMockDataIdToCategory($schema);
        $this->configureProductIdentity($schema);
    }

    /**
     * @param Schema $schema
     */
    private function addTransportColumns(Schema $schema)
    {
        $table = $schema->getTable('oro_integration_transport');
        $table->addColumn('mock_data_api_url', 'string', ['notnull' => false]);
    }

    /**
     * @param Schema $schema
     */
    private function addMockDataIdToCategory(Schema $schema)
    {
        $table = $schema->getTable('oro_catalog_category');
        $table->changeColumn('id', ['oro_options' => ['importexport' => ['identity' => false]]]);
        $table->addColumn('mockDataId', 'integer', [
            'notnull' => false,
            'oro_options' => [
                'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
                'form' => ['is_enabled' => false],
                'datagrid' => ['is_visible' => DatagridScope::IS_VISIBLE_FALSE],
                'importexport' => ['excluded' => false, 'identity' => true],
            ]
        ]);
    }

    /**
     * @param Schema $schema
     */
    private function configureProductIdentity(Schema $schema)
    {
        $table = $schema->getTable('oro_product');
        $table->changeColumn('id', ['oro_options' => ['importexport' => ['identity' => false]]]);
    }
}
