<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @version    1.0.0
 */

namespace BasilMH\ContactUsExt\Setup;

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
        $tableName = $installer->getTable('basilmh_contactusext_messages');

        if (!$installer->tableExists('basilmh_contactusext_messages')) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'message_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Message ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                        'default' => ''
                    ],
                    'Name'
                )
                ->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                        'default' => ''
                    ],
                    'Email'
                )
                ->addColumn(
                    'telephone',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                        'default' => ''
                    ],
                    'Telephone'
                )
                ->addColumn(
                    'comment',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                        'default' => ''
                    ],
                    'Comment'
                )
                ->addColumn(
                    'store_id',
                    Table::TYPE_SMALLINT,
                    null,
                    [
                        'nullable' => false
                    ],
                    'Store ID'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                        'default' => 0
                    ],
                    'Store ID'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT
                    ],
                    'Created At'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT_UPDATE
                    ],
                    'Updated At'
                );;
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}