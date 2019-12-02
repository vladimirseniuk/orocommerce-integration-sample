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
    }

    /**
     * @param Schema $schema
     */
    public function addTransportColumns(Schema $schema)
    {
        $transportTable = $schema->getTable('oro_integration_transport');
        $transportTable->addColumn('mock_data_api_url', 'string', ['notnull' => false]);
        $transportTable->addColumn('ldap_port', 'integer', ['notnull' => false]);
        $transportTable->addColumn('ldap_encryption', 'string', ['notnull' => false]);
        $transportTable->addColumn('ldap_base_dn', 'string', ['notnull' => false]);
        $transportTable->addColumn('ldap_username', 'string', ['notnull' => false]);
        $transportTable->addColumn('ldap_password', 'string', ['notnull' => false]);
        $transportTable->addColumn('ldap_account_domain', 'string', ['notnull' => false]);
        $transportTable->addColumn('ldap_account_domain_short', 'string', ['notnull' => false]);
    }

    /**
     * @param Schema $schema
     */
    private function addMockDataIdToCategory(Schema $schema)
    {
        $userTable = $schema->getTable('oro_catalog_category');
        $userTable->changeColumn('id', ['oro_options' => ['importexport' => ['identity' => false]]]);
        $userTable->addColumn('mockDataId', 'integer', [
            'notnull' => false,
            'oro_options' => [
                'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
                'form' => ['is_enabled' => false],
                'datagrid' => ['is_visible' => DatagridScope::IS_VISIBLE_FALSE],
                'importexport' => ['excluded' => false, 'identity' => true],
            ]
        ]);
    }
}
