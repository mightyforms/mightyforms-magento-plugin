<?php

namespace Porthas\MightyForms\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Get table
        $tableName = $installer->getTable('mightyforms_api_key');

        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($tableName) !== true) {
            // Create mightyforms_api_key table
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    100,
                        ['primary' => true, 'nullable' => false, 'default' => 1]
                    )
                ->addColumn(
                    'api_key',
                    Table::TYPE_TEXT,
                    100,
                    ['nullable' => true, 'default' => null])

                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}